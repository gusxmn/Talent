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
     * 
     * Seeder ini membaca data dari file CSV dan memasukkannya ke tabel kecamatans
     */
    public function run(): void
    {
        $csvFile = database_path('data/kecamatan.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca CSV kabupaten untuk mapping ID CSV -> nama kabupaten
        $kabupatenCsvFile = database_path('data/kabupaten.csv');
        $kabupatenMap = []; // CSV ID -> nama kabupaten
        
        if (file_exists($kabupatenCsvFile)) {
            $file = fopen($kabupatenCsvFile, 'r');
            fgetcsv($file); // Skip header
            while (($row = fgetcsv($file)) !== false) {
                if (count($row) >= 3 && !empty($row[0])) {
                    $kabupatenMap[trim($row[0])] = trim($row[2]); // ID CSV -> nama
                }
            }
            fclose($file);
        }

        // Baca file CSV kecamatan
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $kecamatans = [];
        $count = 0;
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
            
            // Cari kabupaten berdasarkan nama (dari mapping)
            $kabupatenNama = $kabupatenMap[$csvKabupatenId] ?? null;
            if (!$kabupatenNama) {
                $skipped++;
                continue;
            }
            
            // Cari kabupaten di database by nama
            $kabupaten = Kabupaten::where('nama_kabupaten', $kabupatenNama)->first();
            if (!$kabupaten) {
                $skipped++;
                continue;
            }
            
            $kecamatans[] = [
                'id' => $csvId,
                'kabupaten_id' => $kabupaten->id,
                'kode_kecamatan' => substr($csvId, -2),
                'nama_kecamatan' => $nama,
                'deskripsi' => isset($row[3]) ? trim($row[3]) : null,
                'status' => true,
            ];
            $count++;
        }

        fclose($file);

        // Insert data ke database
        foreach ($kecamatans as $kecamatan) {
            try {
                Kecamatan::updateOrCreate(
                    ['id' => $kecamatan['id']],
                    $kecamatan
                );
            } catch (\Exception $e) {
                $this->command->warn("Error: {$e->getMessage()}");
            }
        }

        $this->command->info("✓ Kecamatan seeder berhasil dijalankan: {$count} data dimuat, {$skipped} data skipped");
    }
}
