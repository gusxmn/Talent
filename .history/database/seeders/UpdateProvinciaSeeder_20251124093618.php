<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data provinsi dengan ID yang benar sesuai standar Indonesia
        $provinces = [
            11 => ['name' => 'ACEH', 'code' => '11'],
            12 => ['name' => 'SUMATERA UTARA', 'code' => '12'],
            13 => ['name' => 'SUMATERA BARAT', 'code' => '13'],
            14 => ['name' => 'RIAU', 'code' => '14'],
            15 => ['name' => 'JAMBI', 'code' => '15'],
            16 => ['name' => 'SUMATERA SELATAN', 'code' => '16'],
            17 => ['name' => 'BENGKULU', 'code' => '17'],
            18 => ['name' => 'LAMPUNG', 'code' => '18'],
            19 => ['name' => 'KEPULAUAN BANGKA BELITUNG', 'code' => '19'],
            21 => ['name' => 'KEPULAUAN RIAU', 'code' => '21'],
            31 => ['name' => 'DKI JAKARTA', 'code' => '31'],
            32 => ['name' => 'JAWA BARAT', 'code' => '32'],
            33 => ['name' => 'JAWA TENGAH', 'code' => '33'],
            34 => ['name' => 'DI YOGYAKARTA', 'code' => '34'],
            35 => ['name' => 'JAWA TIMUR', 'code' => '35'],
            36 => ['name' => 'BANTEN', 'code' => '36'],
            51 => ['name' => 'BALI', 'code' => '51'],
            52 => ['name' => 'NUSA TENGGARA BARAT', 'code' => '52'],
            53 => ['name' => 'NUSA TENGGARA TIMUR', 'code' => '53'],
            61 => ['name' => 'KALIMANTAN BARAT', 'code' => '61'],
            62 => ['name' => 'KALIMANTAN TENGAH', 'code' => '62'],
            63 => ['name' => 'KALIMANTAN SELATAN', 'code' => '63'],
            64 => ['name' => 'KALIMANTAN TIMUR', 'code' => '64'],
            65 => ['name' => 'KALIMANTAN UTARA', 'code' => '65'],
            71 => ['name' => 'SULAWESI UTARA', 'code' => '71'],
            72 => ['name' => 'SULAWESI TENGAH', 'code' => '72'],
            73 => ['name' => 'SULAWESI SELATAN', 'code' => '73'],
            74 => ['name' => 'SULAWESI TENGGARA', 'code' => '74'],
            75 => ['name' => 'GORONTALO', 'code' => '75'],
            76 => ['name' => 'SULAWESI BARAT', 'code' => '76'],
            81 => ['name' => 'MALUKU', 'code' => '81'],
            82 => ['name' => 'MALUKU UTARA', 'code' => '82'],
            91 => ['name' => 'PAPUA BARAT', 'code' => '91'],
            94 => ['name' => 'PAPUA', 'code' => '94'],
        ];

        // Truncate table untuk reset
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('provinsis')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            // PostgreSQL
            DB::statement('DELETE FROM provinsis');
            DB::statement('ALTER SEQUENCE provinsis_id_seq RESTART WITH 1');
        }

        // Insert new data
        foreach ($provinces as $id => $data) {
            DB::table('provinsis')->insert([
                'id' => $id,
                'kode_provinsi' => $data['code'],
                'nama_provinsi' => $data['name'],
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Provinsi data updated successfully with correct IDs!');
    }
}
