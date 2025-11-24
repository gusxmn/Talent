<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;

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

        // Cek apakah file CSV ada
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca file CSV
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        
        $kecamatans = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 4 && !empty($row[0])) {
                $kecamatans[] = [
                    'id' => trim($row[0]),
                    'kabupaten_id' => trim($row[1]),
                    'kode_kecamatan' => trim($row[2]),
                    'nama_kecamatan' => trim($row[3]),
                    'deskripsi' => isset($row[4]) ? trim($row[4]) : null,
                    'status' => isset($row[5]) ? (filter_var(trim($row[5]), FILTER_VALIDATE_BOOLEAN) ?? true) : true,
                ];
                $count++;
            }
        }

        fclose($file);

        // Insert data ke database dengan updateOrCreate menggunakan Model
        foreach ($kecamatans as $kecamatan) {
            Kecamatan::updateOrCreate(
                ['id' => $kecamatan['id']],
                $kecamatan
            );
        }

        $this->command->info("✓ Kecamatan seeder berhasil dijalankan: {$count} data dimuat");
    }
}
