<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateKecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing kecamatan data
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('kecamatans')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            // PostgreSQL
            DB::statement('DELETE FROM kecamatans');
            DB::statement('ALTER SEQUENCE kecamatans_id_seq RESTART WITH 1');
        }

        // Read CSV file
        $csvFile = database_path('data/kecamatan.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: $csvFile");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        
        $count = 0;
        $errors = 0;
        
        while (($row = fgetcsv($file)) !== false) {
            try {
                $kecamatan_id = intval($row[0]);
                $kabupaten_id = intval($row[1]);
                $name = trim($row[2]);
                
                // Check if kabupaten exists
                $kabupaten = DB::table('kabupatens')->where('id', $kabupaten_id)->first();
                
                if ($kabupaten) {
                    DB::table('kecamatans')->insert([
                        'id' => $kecamatan_id,
                        'kabupaten_id' => $kabupaten_id,
                        'nama_kecamatan' => $name,
                        'kode_kecamatan' => substr((string)$kecamatan_id, -2), // Last 2 digits
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $count++;
                } else {
                    if ($errors < 5) {
                        $this->command->warn("Kabupaten dengan ID {$kabupaten_id} tidak ditemukan untuk {$name}");
                    }
                    $errors++;
                }
            } catch (\Exception $e) {
                if ($errors < 5) {
                    $this->command->warn("Error: " . $e->getMessage());
                }
                $errors++;
            }
        }
        
        fclose($file);
        
        $this->command->info("Successfully inserted $count kecamatan!");
        if ($errors > 0) {
            $this->command->warn("Total errors: $errors");
        }
    }
}
