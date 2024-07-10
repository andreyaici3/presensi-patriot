<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classes;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\MasterJadwal;
use App\Models\TimesSlot;
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
                UserSeeder::class,
                AcademicYearsSeeder::class,
                TeachersSeeder::class,
                MajorsSeeder::class,
                ClassSeeder::class,
                DaysSeeder::class,
                TimesSlotsSeeder::class,
                // SchedulessSeeder::class,
                // JurusanSeeder::class,
                // KelasSeeder::class,
                // HariSeeder::class,
                // MasterJamSeeder::class,
                // MasterJadwalSeeder::class,
                // JadwalSeeder::class,
                // AbsenSeeder::class,

            ]
        );

    }
}
