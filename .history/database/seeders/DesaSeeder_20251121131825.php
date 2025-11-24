<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first kecamatan to use for sample data
        $firstKecamatan = Kecamatan::first();
        
        if (!$firstKecamatan) {
            echo "\n❌ ERROR: Kecamatan table is empty. Please run KecamatanCSVSeeder first.\n";
            return;
        }

        // Sample desa data - using first 3 kecamatan
        $kecamatans = Kecamatan::limit(3)->get();
        $counter = 1;
        $desas = [];

        foreach ($kecamatans as $kecamatan) {
            // Create 3-5 sample desa per kecamatan
            $dosaPerKecamatan = [
                [
                    'kecamatan_id' => $kecamatan->id,
                    'kode_desa' => $kecamatan->kode_kecamatan . '001',
                    'nama_desa' => 'Desa ' . $kecamatan->nama_kecamatan . ' I',
                    'jenis' => 'Desa',
                    'kodepos' => '00000',
                    'deskripsi' => 'Desa di ' . $kecamatan->nama_kecamatan,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kecamatan_id' => $kecamatan->id,
                    'kode_desa' => $kecamatan->kode_kecamatan . '002',
                    'nama_desa' => 'Desa ' . $kecamatan->nama_kecamatan . ' II',
                    'jenis' => 'Desa',
                    'kodepos' => '00000',
                    'deskripsi' => 'Desa di ' . $kecamatan->nama_kecamatan,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kecamatan_id' => $kecamatan->id,
                    'kode_desa' => $kecamatan->kode_kecamatan . '003',
                    'nama_desa' => 'Kelurahan ' . $kecamatan->nama_kecamatan,
                    'jenis' => 'Kelurahan',
                    'kodepos' => '00000',
                    'deskripsi' => 'Kelurahan di ' . $kecamatan->nama_kecamatan,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            $desas = array_merge($desas, $dosaPerKecamatan);
        }

        // Insert desa data in chunks
        $chunks = array_chunk($desas, 500);
        $totalInserted = 0;

        foreach ($chunks as $chunk) {
            DB::table('desas')->insert($chunk);
            $totalInserted += count($chunk);
            echo "\n✅ Inserted {$totalInserted} desa records...";
        }

        $totalCount = DB::table('desas')->count();
        echo "\n✅ SUCCESS: Total {$totalCount} desa records seeded.\n";
                'jenis' => 'Desa',
                'kodepos' => '23552',
                'deskripsi' => 'Desa Meulaboh Barat',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => 33,
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
