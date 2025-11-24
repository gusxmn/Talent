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
        $desas = [];

        foreach ($kecamatans as $kecamatan) {
            // Create 3 sample desa per kecamatan
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

        // Insert desa data
        DB::table('desas')->insert($desas);
        
        $totalCount = DB::table('desas')->count();
        echo "\n✅ SUCCESS: Total {$totalCount} desa records seeded.\n";
    }
}
