<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing kabupaten data
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('kabupatens')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            // PostgreSQL
            DB::statement('DELETE FROM kabupatens');
            DB::statement('ALTER SEQUENCE kabupatens_id_seq RESTART WITH 1');
        }

        // Read CSV file
        $csvFile = database_path('data/kabupaten.csv');
        
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
                $kabupaten_id = intval($row[0]);
                $provinsi_id = intval($row[1]);
                $name = trim($row[2]);
                
                // Check if provinsi exists
                $provinsi = DB::table('provinsis')->where('id', $provinsi_id)->first();
                
                if ($provinsi) {
                    DB::table('kabupatens')->insert([
                        'id' => $kabupaten_id,
                        'provinsi_id' => $provinsi_id,
                        'nama_kabupaten' => $name,
                        'kode_kabupaten' => substr((string)$kabupaten_id, -2), // Last 2 digits
                        'jenis' => (strpos($name, 'KOTA') !== false) ? 'Kota' : 'Kabupaten',
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $count++;
                } else {
                    if ($errors < 5) {
                        $this->command->warn("Provinsi dengan ID {$provinsi_id} tidak ditemukan untuk {$name}");
                    }
                    $errors++;
                }
            } catch (\Exception $e) {
                if ($errors < 5) {
                    $this->command->warn("Error at row: " . $e->getMessage());
                }
                $errors++;
            }
        }
        
        fclose($file);
        
        $this->command->info("Successfully inserted $count kabupaten!");
        if ($errors > 0) {
            $this->command->warn("Total errors: $errors");
        }
    }
}
