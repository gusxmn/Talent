<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing desa data
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('desas')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            // PostgreSQL
            DB::statement('DELETE FROM desas');
            DB::statement('ALTER SEQUENCE desas_id_seq RESTART WITH 1');
        }

        // Read CSV file
        $csvFile = database_path('data/desa.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: $csvFile");
            return;
        }

        $file = fopen($csvFile, 'r');
        
        $count = 0;
        $errors = 0;
        $existingCount = 0;
        
        while (($row = fgetcsv($file)) !== false) {
            try {
                $desa_id = intval($row[0]);
                $kecamatan_id = intval($row[1]);
                $name = trim($row[2]);
                
                // Check if desa already exists
                $existing = DB::table('desas')->where('id', $desa_id)->first();
                
                if ($existing) {
                    $existingCount++;
                    continue;
                }
                
                // Check if kecamatan exists
                $kecamatan = DB::table('kecamatans')->where('id', $kecamatan_id)->first();
                
                if ($kecamatan) {
                    DB::table('desas')->insert([
                        'id' => $desa_id,
                        'kecamatan_id' => $kecamatan_id,
                        'kode_desa' => substr((string)$desa_id, -3), // Last 3 digits
                        'nama_desa' => $name,
                        'jenis' => 'Desa',
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $count++;
                    
                    if ($count % 5000 == 0) {
                        $this->command->info("Processed $count desa...");
                    }
                } else {
                    if ($errors < 5) {
                        $this->command->warn("Kecamatan dengan ID {$kecamatan_id} tidak ditemukan untuk {$name}");
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
        
        $this->command->info("Successfully inserted $count desa!");
        if ($existingCount > 0) {
            $this->command->info("Skipped $existingCount existing desa!");
        }
        if ($errors > 0) {
            $this->command->warn("Total errors: $errors");
        }
    }
}
