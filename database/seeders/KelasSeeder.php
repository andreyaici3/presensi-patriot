<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //untuk rombel X TJKT
        collect([
            [
                'id_jurusan' => 1,
                'nama_kelas' => "X",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "X",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "X",
                "rombel" => 3,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "X",
                "rombel" => 4,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "X",
                "rombel" => 5,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        // Rombel X TO
        collect([
            [
                'id_jurusan' => 2,
                'nama_kelas' => "X",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 2,
                'nama_kelas' => "X",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 2,
                'nama_kelas' => "X",
                "rombel" => 3,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        //ROMBEL X LK
        collect([
            [
                'id_jurusan' => 3,
                'nama_kelas' => "X",
                "rombel" => 1,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        //ROMBEL X MPLB
        collect([
            [
                'id_jurusan' => 4,
                'nama_kelas' => "X",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "X",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "X",
                "rombel" => 3,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "X",
                "rombel" => 4,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        //ROMBRL 10 AKL

        collect([
            [
                'id_jurusan' => 5,
                'nama_kelas' => "X",
                "rombel" => 1,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });


        //untuk rombel XI TJKT
        collect([
            [
                'id_jurusan' => 1,
                'nama_kelas' => "XI",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "XI",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "XI",
                "rombel" => 3,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "XI",
                "rombel" => 4,
            ],
            [
                'id_jurusan' => 1,
                'nama_kelas' => "XI",
                "rombel" => 5,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

         // Rombel XI TO
         collect([
            [
                'id_jurusan' => 2,
                'nama_kelas' => "XI",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 2,
                'nama_kelas' => "XI",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 2,
                'nama_kelas' => "XI",
                "rombel" => 3,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });


         //ROMBEL XI LK
         collect([
            [
                'id_jurusan' => 3,
                'nama_kelas' => "XI",
                "rombel" => 1,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        //ROMBEL XI MPLB
        collect([
            [
                'id_jurusan' => 4,
                'nama_kelas' => "XI",
                "rombel" => 1,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "XI",
                "rombel" => 2,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "XI",
                "rombel" => 3,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "XI",
                "rombel" => 4,
            ],
            [
                'id_jurusan' => 4,
                'nama_kelas' => "XI",
                "rombel" => 5,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });

        //ROMBRL XI AKL

        collect([
            [
                'id_jurusan' => 5,
                'nama_kelas' => "XI",
                "rombel" => 1,
            ],
        ])->each(function ($kelas) {
            Kelas::create($kelas);
        });


    }
}
