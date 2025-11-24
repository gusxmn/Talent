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

        // Baca CSV kabupaten untuk mapping ID CSV -> ID database
        $kabupatenCsvFile = database_path('data/kabupaten.csv');
        $kabupatenMap = []; // CSV ID -> nama
        
        if (file_exists($kabupatenCsvFile)) {
            $file = fopen($kabupatenCsvFile, 'r');
            fgetcsv($file); // Skip header
            while (($row = fgetcsv($file)) !== false) {
                if (count($row) >= 3 && !empty($row[0])) {
                    $csvId = trim($row[0]);
                    $nama = trim($row[2]);
                    $kabupatenMap[$csvId] = $nama;
                }
            }
            fclose($file);
        }

        // Debug: tampilkan sample kabupaten
        $this->command->line("Sample kabupaten di database:");
        $sampleKab = Kabupaten::limit(3)->get();
        foreach ($sampleKab as $kab) {
            $this->command->line("  - ID: {$kab->id}, Nama: {$kab->nama_kabupaten}");
        }

        // Baca file CSV kecamatan
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $count = 0;
        $skipped = 0;
        $inserted = 0;

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
            
            // Cari nama kabupaten dari mapping
            $kabupatenNama = $kabupatenMap[$csvKabupatenId] ?? null;
            if (!$kabupatenNama) {
                $this->command->warn("Kabupaten CSV ID {$csvKabupatenId} tidak ditemukan di mapping");
                $skipped++;
                continue;
            }
            
            // Cari kabupaten di database berdasarkan nama
            $kabupaten = Kabupaten::where('nama_kabupaten', $kabupatenNama)->first();
            if (!$kabupaten) {
                $this->command->warn("Kabupaten '{$kabupatenNama}' tidak ditemukan di database");
                $skipped++;
                continue;
            }
            
            try {
                // Insert dengan direct query untuk lebih cepat
                DB::table('kecamatans')->updateOrInsert(
                    ['id' => $csvId],
                    [
                        'kabupaten_id' => $kabupaten->id,
                        'kode_kecamatan' => substr($csvId, -2),
                        'nama_kecamatan' => $nama,
                        'deskripsi' => isset($row[3]) ? trim($row[3]) : null,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                $inserted++;
                
                // Show progress setiap 100 baris
                if ($inserted % 100 == 0) {
                    $this->command->line("Telah insert: {$inserted} data...");
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
}
