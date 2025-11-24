<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data kecamatan for Kabupaten Aceh Barat (id: 1107)
        $kecamatans = [
            [
                'kabupaten_id' => 1107,
                'kode_kecamatan' => '1107010',
                'nama_kecamatan' => 'Arongan Lambalek',
                'deskripsi' => 'Kecamatan Arongan Lambalek',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1107,
                'kode_kecamatan' => '1107020',
                'nama_kecamatan' => 'Blang Pidie',
                'deskripsi' => 'Kecamatan Blang Pidie',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1107,
                'kode_kecamatan' => '1107030',
                'nama_kecamatan' => 'Gunung Meriah',
                'deskripsi' => 'Kecamatan Gunung Meriah',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1107,
                'kode_kecamatan' => '1107040',
                'nama_kecamatan' => 'Jeunieb',
                'deskripsi' => 'Kecamatan Jeunieb',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1107,
                'kode_kecamatan' => '1107050',
                'nama_kecamatan' => 'Kaway XVI',
                'deskripsi' => 'Kecamatan Kaway XVI',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sample data for Kabupaten Aceh Barat Daya (id: 1112)
            [
                'kabupaten_id' => 1112,
                'kode_kecamatan' => '1112010',
                'nama_kecamatan' => 'Blang Pidie',
                'deskripsi' => 'Kecamatan Blang Pidie',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1112,
                'kode_kecamatan' => '1112020',
                'nama_kecamatan' => 'Kuala Bhee',
                'deskripsi' => 'Kecamatan Kuala Bhee',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1112,
                'kode_kecamatan' => '1112030',
                'nama_kecamatan' => 'Manggeng',
                'deskripsi' => 'Kecamatan Manggeng',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1112,
                'kode_kecamatan' => '1112040',
                'nama_kecamatan' => 'Samatiga',
                'deskripsi' => 'Kecamatan Samatiga',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1112,
                'kode_kecamatan' => '1112050',
                'nama_kecamatan' => 'Susoh',
                'deskripsi' => 'Kecamatan Susoh',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sample data for Kabupaten Aceh Besar (id: 1108)
            [
                'kabupaten_id' => 1108,
                'kode_kecamatan' => '1108010',
                'nama_kecamatan' => 'Baitussalam',
                'deskripsi' => 'Kecamatan Baitussalam',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1108,
                'kode_kecamatan' => '1108020',
                'nama_kecamatan' => 'Darussalam',
                'deskripsi' => 'Kecamatan Darussalam',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1108,
                'kode_kecamatan' => '1108030',
                'nama_kecamatan' => 'Jantho',
                'deskripsi' => 'Kecamatan Jantho',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1108,
                'kode_kecamatan' => '1108040',
                'nama_kecamatan' => 'Kuta Alam',
                'deskripsi' => 'Kecamatan Kuta Alam',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kabupaten_id' => 1108,
                'kode_kecamatan' => '1108050',
                'nama_kecamatan' => 'Ulim',
                'deskripsi' => 'Kecamatan Ulim',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kecamatans')->insert($kecamatans);
    }
}
