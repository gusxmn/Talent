<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Provinsi Indonesia
        $provinsiData = [
            ['kode' => '11', 'nama' => 'Aceh'],
            ['kode' => '12', 'nama' => 'Sumatera Utara'],
            ['kode' => '13', 'nama' => 'Sumatera Barat'],
            ['kode' => '14', 'nama' => 'Riau'],
            ['kode' => '15', 'nama' => 'Jambi'],
            ['kode' => '16', 'nama' => 'Sumatera Selatan'],
            ['kode' => '17', 'nama' => 'Lampung'],
            ['kode' => '18', 'nama' => 'Kepulauan Bangka Belitung'],
            ['kode' => '19', 'nama' => 'Kepulauan Riau'],
            ['kode' => '21', 'nama' => 'Jawa Barat'],
            ['kode' => '31', 'nama' => 'Jawa Tengah'],
            ['kode' => '32', 'nama' => 'Jawa Timur'],
            ['kode' => '33', 'nama' => 'Daerah Istimewa Yogyakarta'],
            ['kode' => '34', 'nama' => 'Banten'],
            ['kode' => '35', 'nama' => 'Bali'],
            ['kode' => '36', 'nama' => 'Nusa Tenggara Barat'],
            ['kode' => '37', 'nama' => 'Nusa Tenggara Timur'],
            ['kode' => '38', 'nama' => 'Kalimantan Barat'],
            ['kode' => '39', 'nama' => 'Kalimantan Tengah'],
            ['kode' => '40', 'nama' => 'Kalimantan Selatan'],
            ['kode' => '41', 'nama' => 'Kalimantan Timur'],
            ['kode' => '42', 'nama' => 'Kalimantan Utara'],
            ['kode' => '50', 'nama' => 'Sulawesi Utara'],
            ['kode' => '51', 'nama' => 'Sulawesi Tengah'],
            ['kode' => '52', 'nama' => 'Sulawesi Selatan'],
            ['kode' => '53', 'nama' => 'Sulawesi Tenggara'],
            ['kode' => '54', 'nama' => 'Gorontalo'],
            ['kode' => '55', 'nama' => 'Sulawesi Barat'],
            ['kode' => '61', 'nama' => 'Maluku'],
            ['kode' => '62', 'nama' => 'Maluku Utara'],
            ['kode' => '71', 'nama' => 'Papua'],
            ['kode' => '72', 'nama' => 'Papua Barat'],
            ['kode' => '74', 'nama' => 'Papua Selatan'],
            ['kode' => '75', 'nama' => 'Papua Tengah'],
            ['kode' => '76', 'nama' => 'Papua Pegunungan'],
        ];

        // Simpan Provinsi
        $provinsiMap = [];
        foreach ($provinsiData as $item) {
            $provinsi = Provinsi::create([
                'kode_provinsi' => $item['kode'],
                'nama_provinsi' => $item['nama'],
                'status' => true,
            ]);
            $provinsiMap[$item['kode']] = $provinsi->id;
        }

        // Data Kabupaten (Sampel untuk beberapa provinsi)
        $kabupatenData = [
            // Provinsi Aceh (11)
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1101', 'nama' => 'Aceh Barat', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1102', 'nama' => 'Aceh Besar', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1103', 'nama' => 'Aceh Jaya', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1104', 'nama' => 'Aceh Utara', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1171', 'nama' => 'Banda Aceh', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['11'], 'kode' => '1172', 'nama' => 'Sabang', 'jenis' => 'Kota'],

            // Provinsi Sumatera Utara (12)
            ['provinsi_id' => $provinsiMap['12'], 'kode' => '1201', 'nama' => 'Asahan', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['12'], 'kode' => '1202', 'nama' => 'Batang Hari', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['12'], 'kode' => '1203', 'nama' => 'Dairi', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['12'], 'kode' => '1271', 'nama' => 'Medan', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['12'], 'kode' => '1272', 'nama' => 'Binjai', 'jenis' => 'Kota'],

            // Provinsi Jawa Barat (21)
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2101', 'nama' => 'Bandung', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2102', 'nama' => 'Bandung Barat', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2103', 'nama' => 'Bekasi', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2104', 'nama' => 'Bogor', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2171', 'nama' => 'Bandung', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2172', 'nama' => 'Bekasi', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['21'], 'kode' => '2173', 'nama' => 'Bogor', 'jenis' => 'Kota'],

            // Provinsi Jawa Tengah (31)
            ['provinsi_id' => $provinsiMap['31'], 'kode' => '3101', 'nama' => 'Banyumas', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['31'], 'kode' => '3102', 'nama' => 'Brebes', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['31'], 'kode' => '3103', 'nama' => 'Cilacap', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['31'], 'kode' => '3171', 'nama' => 'Purwokerto', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['31'], 'kode' => '3172', 'nama' => 'Semarang', 'jenis' => 'Kota'],

            // Provinsi Jawa Timur (32)
            ['provinsi_id' => $provinsiMap['32'], 'kode' => '3201', 'nama' => 'Bangkalan', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['32'], 'kode' => '3202', 'nama' => 'Batu', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['32'], 'kode' => '3203', 'nama' => 'Blitar', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['32'], 'kode' => '3271', 'nama' => 'Surabaya', 'jenis' => 'Kota'],
            ['provinsi_id' => $provinsiMap['32'], 'kode' => '3272', 'nama' => 'Malang', 'jenis' => 'Kota'],

            // Provinsi DI Yogyakarta (33)
            ['provinsi_id' => $provinsiMap['33'], 'kode' => '3301', 'nama' => 'Bantul', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['33'], 'kode' => '3302', 'nama' => 'Gunung Kidul', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['33'], 'kode' => '3303', 'nama' => 'Kulonprogo', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['33'], 'kode' => '3371', 'nama' => 'Yogyakarta', 'jenis' => 'Kota'],

            // Provinsi Bali (35)
            ['provinsi_id' => $provinsiMap['35'], 'kode' => '3501', 'nama' => 'Badung', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['35'], 'kode' => '3502', 'nama' => 'Bangli', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['35'], 'kode' => '3503', 'nama' => 'Buleleng', 'jenis' => 'Kabupaten'],
            ['provinsi_id' => $provinsiMap['35'], 'kode' => '3571', 'nama' => 'Denpasar', 'jenis' => 'Kota'],
        ];

        // Simpan Kabupaten
        foreach ($kabupatenData as $item) {
            Kabupaten::create([
                'provinsi_id' => $item['provinsi_id'],
                'kode_kabupaten' => $item['kode'],
                'nama_kabupaten' => $item['nama'],
                'jenis' => $item['jenis'],
                'status' => true,
            ]);
        }

        $this->command->info('✅ LocationSeeder berhasil dijalankan!');
        $this->command->info('📍 Provinsi: ' . count($provinsiData));
        $this->command->info('🏙️ Kabupaten: ' . count($kabupatenData));
    }
}
