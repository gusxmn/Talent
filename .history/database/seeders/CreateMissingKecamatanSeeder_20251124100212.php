<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateMissingKecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all desa records that fail due to missing kecamatan
        // Extract unique kecamatan_ids from CSV that don't exist in database
        
        $csvFile = database_path('data/desa.csv');
        $file = fopen($csvFile, 'r');
        
        $missingKecamatan = [];
        $existingKecamatan = DB::table('kecamatans')->pluck('id')->toArray();
        $existingKecamatanSet = array_flip($existingKecamatan);
        
        $this->command->info("Scanning CSV for missing kecamatan...");
        
        while (($row = fgetcsv($file)) !== false) {
            if (empty($row) || count($row) < 2) {
                continue;
            }
            
            $kecamatan_id = intval($row[1]);
            
            if (!isset($existingKecamatanSet[$kecamatan_id]) && !isset($missingKecamatan[$kecamatan_id])) {
                $missingKecamatan[$kecamatan_id] = true;
            }
        }
        fclose($file);
        
        $this->command->info("Found " . count($missingKecamatan) . " missing kecamatan");
        
        // Try to create missing kecamatan
        $created = 0;
        $failed = 0;
        $errors = [];
        
        foreach (array_keys($missingKecamatan) as $kecamatan_id) {
            // Extract kabupaten_id (first 4 digits)
            $kabupaten_id = intval(substr((string)$kecamatan_id, 0, 4));
            
            $kabupaten = DB::table('kabupatens')->where('id', $kabupaten_id)->first();
            
            if ($kabupaten) {
                // Kabupaten exists, create kecamatan
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
                    $created++;
                } catch (\Exception $e) {
                    $failed++;
                    if (count($errors) < 10) {
                        $errors[] = "Kecamatan $kecamatan_id: " . $e->getMessage();
                    }
                }
            } else {
                // Kabupaten doesn't exist - need to create it or skip
                // Try to extract province from kabupaten_id
                $provinsi_id = intval(substr((string)$kabupaten_id, 0, 2));
                $provinsi = DB::table('provinsis')->where('id', $provinsi_id)->first();
                
                if ($provinsi) {
                    // Create missing kabupaten first
                    try {
                        DB::table('kabupatens')->insert([
                            'id' => $kabupaten_id,
                            'provinsi_id' => $provinsi_id,
                            'nama_kabupaten' => 'Kabupaten ' . $kabupaten_id,
                            'kode_kabupaten' => substr((string)$kabupaten_id, -2),
                            'jenis' => 'Kabupaten',
                            'status' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        
                        // Then create kecamatan
                        DB::table('kecamatans')->insert([
                            'id' => $kecamatan_id,
                            'kabupaten_id' => $kabupaten_id,
                            'nama_kecamatan' => 'Kecamatan ' . $kecamatan_id,
                            'kode_kecamatan' => substr((string)$kecamatan_id, -2),
                            'status' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $created++;
                        
                        $this->command->info("Created kabupaten $kabupaten_id and kecamatan $kecamatan_id");
                    } catch (\Exception $e) {
                        $failed++;
                        if (count($errors) < 10) {
                            $errors[] = "Kabupaten $kabupaten_id + Kecamatan $kecamatan_id: " . $e->getMessage();
                        }
                    }
                } else {
                    $failed++;
                    if (count($errors) < 10) {
                        $errors[] = "Kecamatan $kecamatan_id: Provinsi $provinsi_id tidak ditemukan";
                    }
                }
            }
        }
        
        $this->command->info("Created $created missing kecamatan!");
        if ($failed > 0) {
            $this->command->warn("Failed to create $failed kecamatan");
        }
        if (!empty($errors)) {
            $this->command->warn("Sample errors:");
            foreach ($errors as $error) {
                $this->command->warn("  $error");
            }
        }
    }
}
