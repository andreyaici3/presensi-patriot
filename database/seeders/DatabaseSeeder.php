<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\MasterJadwal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                // GuruSeeder::class,
                JurusanSeeder::class,
                KelasSeeder::class,
                HariSeeder::class,
                MasterJamSeeder::class,
                // MasterJadwalSeeder::class,
                // JadwalSeeder::class,
                // AbsenSeeder::class,
                UserSeeder::class,
            ]
        );       
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
