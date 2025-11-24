<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data desa for Kecamatan Arongan Lambalek (id: 1)
        $desas = [
            [
                'kecamatan_id' => 1,
                'kode_desa' => '110701001',
                'nama_desa' => 'Desa Arongan',
                'jenis' => 'Desa',
                'kodepos' => '23551',
                'deskripsi' => 'Desa Arongan',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 1,
                'kode_desa' => '110701002',
                'nama_desa' => 'Desa Lambalek',
                'jenis' => 'Desa',
                'kodepos' => '23551',
                'deskripsi' => 'Desa Lambalek',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 1,
                'kode_desa' => '110701003',
                'nama_desa' => 'Kelurahan Pulo Nasan',
                'jenis' => 'Kelurahan',
                'kodepos' => '23551',
                'deskripsi' => 'Kelurahan Pulo Nasan',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Kecamatan Blang Pidie (id: 2)
            [
                'kecamatan_id' => 2,
                'kode_desa' => '110702001',
                'nama_desa' => 'Desa Blang Pidie',
                'jenis' => 'Desa',
                'kodepos' => '23555',
                'deskripsi' => 'Desa Blang Pidie',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 2,
                'kode_desa' => '110702002',
                'nama_desa' => 'Desa Peudada',
                'jenis' => 'Desa',
                'kodepos' => '23555',
                'deskripsi' => 'Desa Peudada',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 2,
                'kode_desa' => '110702003',
                'nama_desa' => 'Kelurahan Paloh',
                'jenis' => 'Kelurahan',
                'kodepos' => '23555',
                'deskripsi' => 'Kelurahan Paloh',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Kecamatan Gunung Meriah (id: 3)
            [
                'kecamatan_id' => 3,
                'kode_desa' => '110703001',
                'nama_desa' => 'Desa Gunung Meriah',
                'jenis' => 'Desa',
                'kodepos' => '23552',
                'deskripsi' => 'Desa Gunung Meriah',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 3,
                'kode_desa' => '110703002',
                'nama_desa' => 'Desa Meulaboh Barat',
                'jenis' => 'Desa',
                'kodepos' => '23552',
                'deskripsi' => 'Desa Meulaboh Barat',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 3,
                'kode_desa' => '110703003',
                'nama_desa' => 'Kelurahan Meulaboh',
                'jenis' => 'Kelurahan',
                'kodepos' => '23552',
                'deskripsi' => 'Kelurahan Meulaboh',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('desas')->insert($desas);
    }
}
