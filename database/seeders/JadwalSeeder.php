<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Untuk Hari Senin Guru Andrey jam ke 1 - 4
        collect([
            [
                "kode_guru" => "63",
                "id_jadwal" => "1",
                "id_kelas" => "15",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "2",
                "id_kelas" => "15",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "3",
                "id_kelas" => "15",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "4",
                "id_kelas" => "15",
                "id_hari" => "1"
            ],

        ])->each(function ($jadwal) {
            Jadwal::create($jadwal);
        });

        //untuk hari senin guru andrey jam ke 5 -8
        collect([
            [
                "kode_guru" => "63",
                "id_jadwal" => "5",
                "id_kelas" => "18",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "6",
                "id_kelas" => "18",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "7",
                "id_kelas" => "18",
                "id_hari" => "1"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "8",
                "id_kelas" => "18",
                "id_hari" => "1"
            ],

        ])->each(function ($jadwal) {
            Jadwal::create($jadwal);
        });

        //untuk hari selasa guru andrey jam ke 3 - 6
        collect([
            [
                "kode_guru" => "63",
                "id_jadwal" => "11",
                "id_kelas" => "17",
                "id_hari" => "2"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "12",
                "id_kelas" => "17",
                "id_hari" => "2"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "13",
                "id_kelas" => "17",
                "id_hari" => "2"
            ],
            [
                "kode_guru" => "63",
                "id_jadwal" => "14",
                "id_kelas" => "17",
                "id_hari" => "2"
            ],

        ])->each(function ($jadwal) {
            Jadwal::create($jadwal);
        });

         //untuk hari rabu guru andrey jam ke 3 - 10
         collect([
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "22",
                "id_kelas"=> "19",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "23",
                "id_kelas"=> "19",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "24",
                "id_kelas"=> "19",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "25",
                "id_kelas"=> "19",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "27",
                "id_kelas"=> "16",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "28",
                "id_kelas"=> "16",
                "id_hari"=> "3"
            ],
            [
                "kode_guru"=> "63",
                "id_jadwal"=> "29",
                "id_kelas"=> "16",
                "id_hari"=> "3"
            ],

        ])->each(function ($jadwal) {
            Jadwal::create($jadwal);
        });
    }
}
