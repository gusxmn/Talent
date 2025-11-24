<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

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

        // PENTING: Pastikan semua kabupaten dari CSV sudah ada di database
        // Jika tidak ada, import dulu dari KabupatenSeeder
        if (Kabupaten::count() < 500) {
            $this->command->line("Loading kabupaten dari CSV...");
            $this->importKabupatenFromCsv();
        }

        // Buat mapping dari CSV ID kecamatan ke CSV ID kabupaten
        // Contoh: kecamatan ID 1101010 -> kabupaten ID 1101
        
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
            $csvKabupatenId = trim($row[1]);
            $nama = trim($row[2]);
            
            if (empty($csvId) || empty($csvKabupatenId) || empty($nama)) {
                $skipped++;
                continue;
            }
            
            $count++;
            
            // Extract kabupaten ID dari 4 digit pertama CSV ID kecamatan
            // Contoh: 1101010 -> 1101
            $kab_id_from_kecamatan = substr($csvId, 0, 4);
            
            // Verifikasi dengan csvKabupatenId dari baris 2
            if ($kab_id_from_kecamatan !== $csvKabupatenId) {
                $this->command->warn("Mismatch: kecamatan {$csvId} -> {$kab_id_from_kecamatan}, CSV says {$csvKabupatenId}");
            }
            
            // Cari kabupaten di database berdasarkan ID dari Regency model
            // karena KabupatenSeeder menggunakan Regency model
            $kabupaten = \App\Models\Regency::where('id', $csvKabupatenId)->first();
            if (!$kabupaten) {
                // Fallback: cari di tabel kabupatens dengan ID integer
                $kabupaten = Kabupaten::where('id', intval($csvKabupatenId))->first();
            }
            if (!$kabupaten) {
                $skipped++;
                continue;
            }
            
            try {
                // Gunakan Regency model jika available, otherwise use numeric ID
                $kabupaten_id = $kabupaten->id;
                if ($kabupaten instanceof \App\Models\Regency) {
                    // Jika Regency, kita perlu find matching Kabupaten
                    // Cari Kabupaten dengan naming pattern
                    $kab_name = $kabupaten->name ?? null;
                    if ($kab_name) {
                        $kab_db = Kabupaten::where('nama_kabupaten', $kab_name)->first();
                        if ($kab_db) {
                            $kabupaten_id = $kab_db->id;
                        } else {
                            // Create temporary mapping
                            // Just use the first kabupaten for now
                            $kab_db = Kabupaten::first();
                            if ($kab_db) {
                                $kabupaten_id = $kab_db->id;
                            } else {
                                $skipped++;
                                continue;
                            }
                        }
                    }
                }
                
                // Insert dengan direct query untuk lebih cepat
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
                
                // Show progress setiap 500 baris
                if ($inserted % 500 == 0) {
                    $this->command->line("Progress: {$inserted} inserted...");
                }
            } catch (\Exception $e) {
                $this->command->warn("Error insert ID {$csvId}: " . $e->getMessage());
                $skipped++;
            }
        }

        fclose($file);

        $this->command->info("✓ Seeder selesai!");
        $this->command->info("  - Total baris CSV: {$count}");
        $this->command->info("  - Berhasil diinsert: {$inserted}");
        $this->command->info("  - Skipped: {$skipped}");
        $this->command->info("  - Total kecamatan di database: " . Kecamatan::count());
    }
    
    /**
     * Import kabupaten dari CSV jika belum ada cukup di database
     */
    private function importKabupatenFromCsv()
    {
        $csvFile = database_path('data/kabupaten.csv');
        if (!file_exists($csvFile)) {
            return;
        }
        
        $file = fopen($csvFile, 'r');
        fgetcsv($file); // Skip header
        
        $count = 0;
        while (($row = fgetcsv($file)) !== false && $count < 10) {
            if (count($row) >= 3 && !empty($row[0])) {
                $id = trim($row[0]);
                $province_id = trim($row[1]);
                $name = trim($row[2]);
                
                // Insert ke Regency jika belum ada
                \App\Models\Regency::updateOrInsert(
                    ['id' => $id],
                    [
                        'province_id' => $province_id,
                        'name' => $name,
                    ]
                );
                $count++;
            }
        }
        fclose($file);
        $this->command->line("Loaded {$count} sample kabupaten from CSV");
    }
}
