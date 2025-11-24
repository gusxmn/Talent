<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed reference data
        $this->call([
            ProvinceSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            KecamatanCSVSeeder::class, // Seeder untuk membaca dari CSV
            DesaSeeder::class,
        ]);
    }
};