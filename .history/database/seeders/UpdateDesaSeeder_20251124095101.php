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
        $lineNum = 0;
        
        $count = 0;
        $errors = [];
        $errorCount = 0;
        
        // Get all kecamatan IDs for quick lookup
        $kecamatanIds = DB::table('kecamatans')->pluck('id')->toArray();
        $kecamatanSet = array_flip($kecamatanIds);
        
        $this->command->info("Processing desa CSV with " . count($kecamatanIds) . " kecamatan in system...");
        
        while (($row = fgetcsv($file)) !== false) {
            $lineNum++;
            
            if (empty($row) || (count($row) < 3)) {
                continue;
            }
            
            try {
                $desa_id = intval($row[0]);
                $kecamatan_id = intval($row[1]);
                $name = trim($row[2]);
                
                // Check if kecamatan exists in our lookup
                if (!isset($kecamatanSet[$kecamatan_id])) {
                    $errorCount++;
                    if (count($errors) < 10) {
                        $errors[] = "Line $lineNum: Kecamatan ID $kecamatan_id tidak ditemukan untuk desa: $name";
                    }
                    continue;
                }
                
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
            } catch (\Exception $e) {
                $errorCount++;
                if (count($errors) < 10) {
                    $errors[] = "Line $lineNum: " . $e->getMessage();
                }
            }
        }
        
        fclose($file);
        
        $this->command->info("Successfully inserted $count desa!");
        if (!empty($errors)) {
            $this->command->warn("Sample errors:");
            foreach ($errors as $error) {
                $this->command->warn("  $error");
            }
        }
        if ($errorCount > 10) {
            $this->command->warn("Total errors: $errorCount (showing first 10)");
        }
    }
}
