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

        // Build cache of regencies untuk lookup lebih cepat
        $regencies = Regency::all()->keyBy('id'); // Key by string ID dari CSV
        $this->command->line("Loaded " . $regencies->count() . " regencies from database");

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

        while (($row = fgetcsv($file)) !== false) {
            if (empty($row[0]) || count($row) < 3) {
                continue;
            }
            
            $csvId = trim($row[0]);
            $regencyId = trim($row[1]);  // ID kabupaten dari CSV
            $nama = trim($row[2]);
            
            if (empty($csvId) || empty($regencyId) || empty($nama)) {
                $skipped++;
                continue;
            }
            
            $count++;
            
            // Cari regency dengan ID dari CSV
            $regency = $regencies[$regencyId] ?? null;
            if (!$regency) {
                $skipped++;
                continue;
            }
            
            try {
                // Insert langsung ke database dengan direct query
                // kabupaten_id di tabel kecamatans adalah ID dari Kabupaten model
                // Tapi kita tidak punya mapping antara Regency (string ID) dan Kabupaten (int ID)
                // Jadi kita perlu cari atau create Kabupaten entry
                
                $kabupatenDb = \App\Models\Kabupaten::where('kode_kabupaten', $regencyId)->first();
                if (!$kabupatenDb) {
                    // Create kabupaten entry dari regency
                    $kabupatenDb = \App\Models\Kabupaten::create([
                        'provinsi_id' => 1, // Default, should be updated
                        'kode_kabupaten' => $regencyId,
                        'nama_kabupaten' => $regency->name ?? '',
                        'jenis' => 'Kabupaten',
                        'status' => true,
                    ]);
                }
                
                // Insert kecamatan
                DB::table('kecamatans')->updateOrInsert(
                    ['id' => $csvId],
                    [
                        'kabupaten_id' => $kabupatenDb->id,
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
                    $this->command->line("Progress: {$inserted} inserted...");
                }
            } catch (\Exception $e) {
                $skipped++;
                if ($skipped <= 10) {
                    $this->command->warn("Error ID {$csvId}: " . substr($e->getMessage(), 0, 100));
                }
            }
        }

        fclose($file);

        $this->command->info("✓ Seeder selesai!");
        $this->command->info("  - Total baris CSV: {$count}");
        $this->command->info("  - Berhasil diinsert: {$inserted}");
        $this->command->info("  - Skipped: {$skipped}");
        $this->command->info("  - Total kecamatan di database: " . Kecamatan::count());
    }
}
