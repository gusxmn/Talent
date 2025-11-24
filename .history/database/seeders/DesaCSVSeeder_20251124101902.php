<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Desa;
use App\Models\Kecamatan;

class DesaCSVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('data/desa.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca dan insert desa dari CSV
        $this->importDesa($csvFile);
    }

    /**
     * Import desa dari CSV
     */
    private function importDesa($csvFile)
    {
        // Cache kecamatans untuk lookup cepat
        $kecamatansMap = Kecamatan::pluck('id', 'id');
        $this->command->line("Loaded " . $kecamatansMap->count() . " kecamatans from database");

        if ($kecamatansMap->count() == 0) {
            $this->command->error("❌ Kecamatan table is empty. Please run KecamatanCSVSeeder first.");
            return;
        }

        // Baca file CSV desa
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $this->command->line("CSV Header: " . implode(", ", $header));
        
        $count = 0;
        $inserted = 0;
        $skipped = 0;
        $missingKec = array();
        $lastTime = now();

        while (($row = fgetcsv($file)) !== false) {
            // Skip empty rows
            if (empty($row[0])) {
                continue;
            }
            
            // Handle variable column count
            $csvId = isset($row[0]) ? trim($row[0]) : '';
            $kecamatanId = isset($row[1]) ? trim($row[1]) : '';
            $namaDesa = isset($row[2]) ? trim($row[2]) : '';
            
            if (empty($csvId) || empty($kecamatanId) || empty($namaDesa)) {
                $skipped++;
                continue;
            }
            
            $count++;
            
            // Lookup kecamatan dari kecamatans table menggunakan ID CSV sebagai kecamatan_id
            $kecamatanRecord = Kecamatan::where('id', $kecamatanId)->first();
            
            if (!$kecamatanRecord) {
                $missingKec[$kecamatanId] = ($missingKec[$kecamatanId] ?? 0) + 1;
                $skipped++;
                continue;
            }
            
            // Generate kode_desa dari ID jika tidak ada
            $kodeDesa = substr($csvId, -3) ?: $csvId;
            
            try {
                DB::table('desas')->updateOrInsert(
                    ['id' => $csvId],
                    [
                        'kecamatan_id' => $kecamatanRecord->id,
                        'kode_desa' => $kodeDesa,
                        'nama_desa' => $namaDesa,
                        'jenis' => 'Desa',
                        'kodepos' => null,
                        'deskripsi' => null,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                $inserted++;
                
                // Show progress setiap 1000 baris
                if ($inserted % 1000 == 0) {
                    $elapsed = now()->diffInSeconds($lastTime);
                    $this->command->line("Progress: {$inserted}/{$count} inserted... ({$elapsed}s)");
                    $lastTime = now();
                }
            } catch (\Exception $e) {
                $skipped++;
                if ($skipped <= 5) {
                    $this->command->warn("Error ID {$csvId}: " . $e->getMessage());
                }
            }
        }

        fclose($file);

        $this->command->info("");
        $this->command->info("✓ SEEDER DESA SELESAI!");
        $this->command->info("════════════════════════════════════");
        $this->command->info("  Total baris CSV       : {$count}");
        $this->command->info("  Berhasil diinsert     : {$inserted}");
        $this->command->info("  Skipped               : {$skipped}");
        if (count($missingKec) > 0) {
            $this->command->warn("  Missing kecamatan IDs: " . json_encode(array_slice($missingKec, 0, 10)));
        }
        $this->command->info("  Total desa DB         : " . Desa::count());
        $this->command->info("════════════════════════════════════");
    }
}
