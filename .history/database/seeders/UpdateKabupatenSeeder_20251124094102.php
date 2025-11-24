<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

        // Fetch kabupaten data from api.go.id
        try {
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json');
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Count total
                $total = count($data);
                $this->command->info("Fetched $total kabupaten from API");
                
                // Insert data
                foreach ($data as $kabupaten) {
                    // Data format from API: ["id" => "1101", "province_id" => "11", "name" => "ACEH BARAT"]
                    $provinsi_id = intval($kabupaten['province_id']); // Convert to int
                    
                    // Check if provinsi exists
                    $provinsi = DB::table('provinsis')->where('id', $provinsi_id)->first();
                    
                    if ($provinsi) {
                        DB::table('kabupatens')->insert([
                            'id' => intval($kabupaten['id']),
                            'provinsi_id' => $provinsi_id,
                            'name' => $kabupaten['name'],
                            'status' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        $this->command->warn("Provinsi dengan ID {$provinsi_id} tidak ditemukan untuk kabupaten {$kabupaten['name']}");
                    }
                }
                
                $count = DB::table('kabupatens')->count();
                $this->command->info("Successfully inserted $count kabupaten!");
            } else {
                $this->command->error('Failed to fetch data from API');
            }
        } catch (\Exception $e) {
            $this->command->error('Error: ' . $e->getMessage());
        }
    }
}
