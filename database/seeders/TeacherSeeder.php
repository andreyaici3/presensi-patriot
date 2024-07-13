<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
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
            ]
        );

    }
}
