<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'kode_jurusan' => "TJKT",
                "nama_jurusan" => "Teknik Komputer dan Jaringan Telekomunikasi"
            ],
            [
                "kode_jurusan" => "TO",
                "nama_jurusan" => "Teknik Otomotif",
            ],
            [
                "kode_jurusan" => 'LK',
                "nama_jurusan" => 'Layanan Kesehatan'
            ],
            [
                "kode_jurusan" => 'MPLB',
                "nama_jurusan" => "Manajemen Perkantoran dan Layanan Bisnis"
            ],
            [
                "kode_jurusan" => "AKL",
                "nama_jurusan" => "Akuntansi dan Keuangan Lembaga",
            ],
            
        ])->each(function($jurusan){
            Jurusan::create($jurusan);
        });
    }
}
