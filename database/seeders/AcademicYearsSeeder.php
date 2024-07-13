<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearsSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            [
                "name" => "GENAP",
                "start_year" => 2023,
                "end_year" => 2024,
                "active" => 0,
            ],
            [
                "name" => "GANJIL",
                "start_year" => 2024,
                "end_year" => 2025,
                "active" => 1,
            ],
        ])->each(function($ta){
            AcademicYear::create($ta);
        });
    }
}
