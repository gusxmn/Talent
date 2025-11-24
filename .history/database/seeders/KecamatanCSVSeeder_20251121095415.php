<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;
use App\Models\Regency;

class KecamatanCSVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/kecamatan.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Langkah 1: Ensure provinsis table populated dari provinces
        $this->syncProvincesToProvinsis();
        
        // Langkah 2: Populate kabupatens table dari regencies jika belum ada
        $this->syncRegenciesToKabupatens();

        // Langkah 3: Baca dan insert kecamatan dari CSV
        $this->importKecamatan($csvFile);
    }
    
    /**
     * Sync data dari provinces ke provinsis table
     */
    private function syncProvincesToProvinsis()
    {
        $provinces = \App\Models\Province::all();
        $this->command->line("Syncing " . $provinces->count() . " provinces to provinsis...");
        
        foreach ($provinces as $prov) {
            try {
                \App\Models\Provinsi::updateOrCreate(
                    ['kode_provinsi' => $prov->id],
                    [
                        'nama_provinsi' => $prov->name,
                        'status' => true,
                    ]
                );
            } catch (\Exception $e) {
                $this->command->warn("Error provinsi {$prov->id}: " . $e->getMessage());
            }
        }
        
        $this->command->line("✓ Provinsis synced: " . \App\Models\Provinsi::count() . " records");
    }
    
    /**
     * Sync data dari regencies ke kabupatens table
     */
    private function syncRegenciesToKabupatens()
    {
        $regencies = \App\Models\Regency::all();
        $this->command->line("Syncing " . $regencies->count() . " regencies to kabupatens...");
        
        $synced = 0;
        foreach ($regencies as $reg) {
            try {
                // Parse provinsi_id dari regency ID (e.g., "1101" -> "11")
                $provinsi_kode = substr($reg->id, 0, 2);
                
                // Find provinsi by kode
                $provinsi = \App\Models\Provinsi::where('kode_provinsi', $provinsi_kode)->first();
                if (!$provinsi) {
                    continue; // Skip jika provinsi tidak ditemukan
                }
                
                // Create atau update kabupaten
                \App\Models\Kabupaten::updateOrCreate(
                    ['kode_kabupaten' => $reg->id],
                    [
                        'provinsi_id' => $provinsi->id,
                        'nama_kabupaten' => $reg->name,
                        'jenis' => (strpos($reg->name, 'KOTA') !== false) ? 'Kota' : 'Kabupaten',
                        'status' => true,
                    ]
                );
                $synced++;
            } catch (\Exception $e) {
                // Ignore errors dan lanjut
            }
        }
        
        $this->command->line("✓ Kabupatens synced: " . $synced . " records");
    }
    
    /**
     * Import kecamatan dari CSV
     */
    private function importKecamatan($csvFile)
    {
        // Cache kabupatens untuk lookup cepat
        $kabupatensMap = \App\Models\Kabupaten::pluck('id', 'kode_kabupaten');
        $this->command->line("Loaded " . $kabupatensMap->count() . " kabupatens from database");

        // Baca file CSV kecamatan
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $count = 0;
        $inserted = 0;
        $skipped = 0;
        $lastTime = now();

        while (($row = fgetcsv($file)) !== false) {
            if (empty($row[0]) || count($row) < 3) {
                continue;
            }
            
            $csvId = trim($row[0]);          // ID kecamatan (e.g., "110101")
            $kabupatenId = trim($row[1]);    // ID kabupaten dari CSV (e.g., "1101")
            $nama = trim($row[2]);           // Nama kecamatan
            
            if (empty($csvId) || empty($kabupatenId) || empty($nama)) {
                $skipped++;
                continue;
            }
            
            $count++;
            
            // Lookup kabupaten_id dari cache
            if (!isset($kabupatensMap[$kabupatenId])) {
                $skipped++;
                continue;
            }
            
            $kabupaten_pk_id = $kabupatensMap[$kabupatenId];
            
            try {
                DB::table('kecamatans')->updateOrInsert(
                    ['id' => $csvId],
                    [
                        'kabupaten_id' => $kabupaten_pk_id,
                        'kode_kecamatan' => substr($csvId, -2),
                        'nama_kecamatan' => $nama,
                        'deskripsi' => isset($row[3]) ? trim($row[3]) : null,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                $inserted++;
                
                // Show progress setiap 500 baris
                if ($inserted % 500 == 0) {
                    $elapsed = now()->diffInSeconds($lastTime);
                    $this->command->line("Progress: {$inserted}/{$count} inserted... ({$elapsed}s)");
                    $lastTime = now();
                }
            } catch (\Exception $e) {
                $skipped++;
            }
        }

        fclose($file);

        $this->command->info("");
        $this->command->info("✓ SEEDER KECAMATAN SELESAI!");
        $this->command->info("════════════════════════════════════");
        $this->command->info("  Total baris CSV       : {$count}");
        $this->command->info("  Berhasil diinsert     : {$inserted}");
        $this->command->info("  Skipped               : {$skipped}");
        $this->command->info("  Total kecamatan DB    : " . Kecamatan::count());
        $this->command->info("════════════════════════════════════");
    }
}
