<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UpdateKabupatenStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aktifkan semua status Kabupaten menjadi true
        DB::table('kabupatens')->update(['status' => true]);
        
        $this->command->info('✓ Successfully activated all Kabupaten status!');
    }
}
