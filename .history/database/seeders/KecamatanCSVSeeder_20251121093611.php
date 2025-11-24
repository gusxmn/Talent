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

        // Cek apakah file CSV ada
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Load all kabupatens untuk mapping dari CSV ID ke database ID
        $kabupatenMap = [];
        foreach (Kabupaten::all() as $kab) {
            // CSV ID seperti 1101, 1102, dst - mapping ke database ID
            // Kita ambil 4 digit pertama dari kecamatan ID untuk mendapatkan kabupaten ID CSV
            $kabupatenMap[$kab->id] = $kab; // database ID sebagai key
        }
        
        // Baca file CSV
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header row
        
        if (!$header) {
            $this->command->error("Tidak dapat membaca header CSV");
            return;
        }
        
        $kecamatans = [];
        $count = 0;
        $skipped = 0;

        while (($row = fgetcsv($file)) !== false) {
            // Skip empty rows
            if (empty($row[0]) || count($row) < 3) {
                continue;
            }
            
            $csvId = trim($row[0] ?? '');
            $csvKabupatenId = trim($row[1] ?? '');
            $nama = trim($row[2] ?? '');
            
            if (empty($csvId) || empty($csvKabupatenId) || empty($nama)) {
                $skipped++;
                continue;
            }
            
            // Cari kabupaten berdasarkan CSV ID (numeric ID dari data CSV)
            $kabupaten = Kabupaten::find($csvKabupatenId);
            
            if (!$kabupaten) {
                // Coba cari dengan naming pattern
                $kabupaten = Kabupaten::where('id', $csvKabupatenId)->first();
            }
            
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
                // Log error tapi lanjut
                $this->command->warn("Error insert kecamatan {$kecamatan['id']}: " . $e->getMessage());
            }
        }

        $this->command->info("✓ Kecamatan seeder berhasil dijalankan: {$count} data dimuat, {$skipped} data skipped");
    }
}
