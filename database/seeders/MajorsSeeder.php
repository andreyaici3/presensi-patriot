<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'code' => "TJKT",
                "name" => "Teknik Komputer dan Jaringan Telekomunikasi"
            ],
            [
                "code" => "TO",
                "name" => "Teknik Otomotif",
            ],
            [
                "code" => 'LK',
                "name" => 'Layanan Kesehatan'
            ],
            [
                "code" => 'MPLB',
                "name" => "Manajemen Perkantoran dan Layanan Bisnis"
            ],
            [
                "code" => "AKL",
                "name" => "Akuntansi dan Keuangan Lembaga",
            ],

        ])->each(function($jurusan){
            Major::create($jurusan);
        });
    }
}
