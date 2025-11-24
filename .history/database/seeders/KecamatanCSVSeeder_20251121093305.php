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
        $header = fgetcsv($file); // Skip header row
        
        // Debug: cek header
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $kecamatans = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            // Skip empty rows
            if (empty($row[0]) || count($row) < 2) {
                continue;
            }
            
            // Pastikan kolom minimal ada
            $id = trim($row[0] ?? '');
            if (empty($id)) {
                continue;
            }
            
            $kecamatans[] = [
                'id' => $id,
                'kabupaten_id' => trim($row[1] ?? ''),
                'kode_kecamatan' => trim($row[2] ?? ''),
                'nama_kecamatan' => trim($row[3] ?? ''),
                'deskripsi' => isset($row[4]) ? trim($row[4]) : null,
                'status' => true, // Default active
            ];
            $count++;
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
