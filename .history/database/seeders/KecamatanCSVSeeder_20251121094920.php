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

        // Langkah 1: Populate kabupatens table dari regencies jika belum ada
        $this->syncRegenciesToKabupatens();

        // Langkah 2: Baca dan insert kecamatan dari CSV
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $count = 0;
        $inserted = 0;
        $skipped = 0;

        // Cache kabupatens untuk lookup cepat
        $kabupatensMap = \App\Models\Kabupaten::pluck('id', 'kode_kabupaten'); // kode -> id

        while (($row = fgetcsv($file)) !== false) {
            if (empty($row[0]) || count($row) < 3) {
                continue;
            }
            
            $csvId = trim($row[0]);
            $regencyId = trim($row[1]);  // CSV ID dari kolom 2
            $nama = trim($row[2]);
            
            if (empty($csvId) || empty($regencyId) || empty($nama)) {
                $skipped++;
                continue;
            }
            
            $count++;
            
            // Cari kabupaten_id dari cache menggunakan regencyId sebagai kode
            $kabupaten_id = $kabupatensMap[$regencyId] ?? null;
            if (!$kabupaten_id) {
                $skipped++;
                continue;
            }
            
            try {
                DB::table('kecamatans')->updateOrInsert(
                    ['id' => $csvId],
                    [
                        'kabupaten_id' => $kabupaten_id,
                        'kode_kecamatan' => substr($csvId, -2),
                        'nama_kecamatan' => $nama,
                        'deskripsi' => isset($row[3]) ? trim($row[3]) : null,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                $inserted++;
                
                if ($inserted % 500 == 0) {
                    $this->command->line("Progress: {$inserted} inserted...");
                }
            } catch (\Exception $e) {
                $skipped++;
            }
        }

        fclose($file);

        $this->command->info("✓ Seeder selesai!");
        $this->command->info("  - Total baris CSV: {$count}");
        $this->command->info("  - Berhasil diinsert: {$inserted}");
        $this->command->info("  - Skipped: {$skipped}");
        $this->command->info("  - Total kecamatan: " . Kecamatan::count());
    }
    
    /**
     * Sync data dari regencies ke kabupatens table
     */
    private function syncRegenciesToKabupatens()
    {
        $regencies = \App\Models\Regency::all();
        $this->command->line("Syncing " . $regencies->count() . " regencies to kabupatens...");
        
        foreach ($regencies as $reg) {
            try {
                // Cek apakah sudah ada
                $exists = \App\Models\Kabupaten::where('kode_kabupaten', $reg->id)->first();
                if ($exists) {
                    continue;
                }
                
                // Insert new kabupaten entry
                // Gunakan provinsi_id = 1 sebagai default (bisa di-update nanti)
                \App\Models\Kabupaten::create([
                    'provinsi_id' => 1,  // Default, should match province
                    'kode_kabupaten' => $reg->id,  // CSV ID
                    'nama_kabupaten' => $reg->name,
                    'jenis' => (strpos($reg->name, 'KOTA') !== false) ? 'Kota' : 'Kabupaten',
                    'status' => true,
                ]);
            } catch (\Exception $e) {
                // Ignore errors dan lanjut
            }
        }
        
        $this->command->line("Sync completed: " . \App\Models\Kabupaten::count() . " kabupatens now in database");
    }
}
