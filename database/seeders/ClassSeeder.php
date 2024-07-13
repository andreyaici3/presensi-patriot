<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //untuk rombel X, XI, XII TJKT
        collect([
            [
                'major_id' => 1,
                'grade' => "X",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 1,
                'grade' => "X",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 1,
                'grade' => "X",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 1,
                'grade' => "X",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 1,
                'grade' => "X",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 1,
                'grade' => "XI",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 1,
                'grade' => "XI",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 1,
                'grade' => "XI",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 1,
                'grade' => "XI",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 1,
                'grade' => "XI",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 1,
                'grade' => "XII",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 1,
                'grade' => "XII",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 1,
                'grade' => "XII",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 1,
                'grade' => "XII",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 1,
                'grade' => "XII",
                "rombel_number" => 5,
            ],
        ])->each(function ($kelas) {
            Classes::create($kelas);
        });

        //untuk rombel X, XII TO
        collect([
            [
                'major_id' => 2,
                'grade' => "X",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 2,
                'grade' => "X",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 2,
                'grade' => "X",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 2,
                'grade' => "X",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 2,
                'grade' => "X",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 2,
                'grade' => "XI",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 2,
                'grade' => "XI",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 2,
                'grade' => "XI",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 2,
                'grade' => "XI",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 2,
                'grade' => "XI",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 2,
                'grade' => "XII",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 2,
                'grade' => "XII",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 2,
                'grade' => "XII",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 2,
                'grade' => "XII",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 2,
                'grade' => "XII",
                "rombel_number" => 5,
            ],
        ])->each(function ($kelas) {
            Classes::create($kelas);
        });

        //untuk rombel X, XI LK
        collect([
            [
                'major_id' => 3,
                'grade' => "X",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 3,
                'grade' => "X",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 3,
                'grade' => "X",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 3,
                'grade' => "XI",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 3,
                'grade' => "XI",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 3,
                'grade' => "XI",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 3,
                'grade' => "XII",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 3,
                'grade' => "XII",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 3,
                'grade' => "XII",
                "rombel_number" => 3,
            ],

        ])->each(function ($kelas) {
            Classes::create($kelas);
        });

        //untuk rombel X, XII MPLB
        collect([
            [
                'major_id' => 4,
                'grade' => "X",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 4,
                'grade' => "X",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 4,
                'grade' => "X",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 4,
                'grade' => "X",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 4,
                'grade' => "X",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 4,
                'grade' => "XI",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 4,
                'grade' => "XI",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 4,
                'grade' => "XI",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 4,
                'grade' => "XI",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 4,
                'grade' => "XI",
                "rombel_number" => 5,
            ],
            [
                'major_id' => 4,
                'grade' => "XII",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 4,
                'grade' => "XII",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 4,
                'grade' => "XII",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 4,
                'grade' => "XII",
                "rombel_number" => 4,
            ],
            [
                'major_id' => 4,
                'grade' => "XII",
                "rombel_number" => 5,
            ],
        ])->each(function ($kelas) {
            Classes::create($kelas);
        });

        //untuk rombel X, XI AKL
        collect([
            [
                'major_id' => 5,
                'grade' => "X",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 5,
                'grade' => "X",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 5,
                'grade' => "X",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 5,
                'grade' => "XI",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 5,
                'grade' => "XI",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 5,
                'grade' => "XI",
                "rombel_number" => 3,
            ],
            [
                'major_id' => 5,
                'grade' => "XII",
                "rombel_number" => 1,
            ],
            [
                'major_id' => 5,
                'grade' => "XII",
                "rombel_number" => 2,
            ],
            [
                'major_id' => 5,
                'grade' => "XII",
                "rombel_number" => 3,
            ],
        ])->each(function ($kelas) {
            Classes::create($kelas);
        });

    }
}
