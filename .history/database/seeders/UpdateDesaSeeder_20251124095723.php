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
        $missingKecamatan = 0;
        $errors = [];
        
        // Get all kecamatan IDs for quick lookup
        $kecamatanIds = DB::table('kecamatans')->pluck('id')->toArray();
        $kecamatanSet = array_flip($kecamatanIds);
        
        $this->command->info("Processing desa CSV...");
        
        $batch = [];
        $batchSize = 100;
        
        while (($row = fgetcsv($file)) !== false) {
            $lineNum++;
            
            if (empty($row) || (count($row) < 3)) {
                continue;
            }
            
            try {
                $desa_id = intval($row[0]);
                $kecamatan_id = intval($row[1]);
                $name = trim($row[2]);
                
                // Skip if values are empty/zero
                if (!$desa_id || !$kecamatan_id) {
                    continue;
                }
                
                // Get or create kecamatan if not exists
                if (!isset($kecamatanSet[$kecamatan_id])) {
                    // Extract kabupaten_id from kecamatan_id (first 4 digits)
                    $kabupaten_id = intval(substr((string)$kecamatan_id, 0, 4));
                    
                    // Check if kabupaten exists
                    $kabupaten = DB::table('kabupatens')->where('id', $kabupaten_id)->first();
                    
                    if ($kabupaten) {
                        // Create missing kecamatan
                        try {
                            DB::table('kecamatans')->insert([
                                'id' => $kecamatan_id,
                                'kabupaten_id' => $kabupaten_id,
                                'nama_kecamatan' => 'Kecamatan ' . $kecamatan_id,
                                'kode_kecamatan' => substr((string)$kecamatan_id, -2),
                                'status' => true,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            $kecamatanSet[$kecamatan_id] = true;
                            $missingKecamatan++;
                        } catch (\Exception $e) {
                            // Kecamatan already exists, skip
                            $kecamatanSet[$kecamatan_id] = true;
                        }
                    } else {
                        if (count($errors) < 10) {
                            $errors[] = "Line $lineNum: Kabupaten ID $kabupaten_id tidak ditemukan untuk kecamatan $kecamatan_id";
                        }
                        continue;
                    }
                }
                
                // Add to batch
                $batch[] = [
                    'id' => $desa_id,
                    'kecamatan_id' => $kecamatan_id,
                    'kode_desa' => substr((string)$desa_id, -3), // Last 3 digits
                    'nama_desa' => $name,
                    'jenis' => 'Desa',
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Insert batch when size reached
                if (count($batch) >= $batchSize) {
                    try {
                        DB::table('desas')->insert($batch);
                        $count += count($batch);
                        $batch = [];
                        
                        if ($count % 10000 == 0) {
                            $this->command->info("Processed $count desa...");
                        }
                    } catch (\Exception $e) {
                        if (count($errors) < 10) {
                            $errors[] = "Batch insert error at line $lineNum: " . $e->getMessage();
                        }
                        // Try individual inserts
                        foreach ($batch as $item) {
                            try {
                                DB::table('desas')->insert($item);
                                $count++;
                            } catch (\Exception $itemError) {
                                if (count($errors) < 10) {
                                    $errors[] = "Individual insert error: " . $itemError->getMessage();
                                }
                            }
                        }
                        $batch = [];
                    }
                }
            } catch (\Exception $e) {
                if (count($errors) < 10) {
                    $errors[] = "Line $lineNum: " . $e->getMessage();
                }
            }
        }
        
        // Insert remaining batch
        if (!empty($batch)) {
            try {
                DB::table('desas')->insert($batch);
                $count += count($batch);
            } catch (\Exception $e) {
                if (count($errors) < 10) {
                    $errors[] = "Final batch error: " . $e->getMessage();
                }
                foreach ($batch as $item) {
                    try {
                        DB::table('desas')->insert($item);
                        $count++;
                    } catch (\Exception $itemError) {
                        if (count($errors) < 10) {
                            $errors[] = "Final individual insert error: " . $itemError->getMessage();
                        }
                    }
                }
            }
        }
        
        fclose($file);
        
        $this->command->info("Successfully inserted $count desa!");
        $this->command->info("Total lines processed: $lineNum");
        if ($missingKecamatan > 0) {
            $this->command->info("Created $missingKecamatan missing kecamatan!");
        }
        if (!empty($errors)) {
            $this->command->warn("Sample errors:");
            foreach ($errors as $error) {
                $this->command->warn("  $error");
            }
        }
        $this->command->info("Seeding completed!");
    }
}
