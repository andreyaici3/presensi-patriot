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
                'code' => "TI",
                "name" => "Teknologi Informasi",
                "program_keahlian" => "Teknik Jaringan Komputer dan Telekomunikasi",
                "konsentrasi_keahlian" => "Teknik Komputer Jaringan"
            ],
            [
                "code" => "TMR",
                "name" => "Teknologi Manufaktur dan Rekayasa",
                "program_keahlian" => "Teknik Otomotif",
                "konsentrasi_keahlian" => "Teknik Sepeda Motor"
            ],
            [
                "code" => 'KPS',
                "name" => 'Kesehatan dan Pekerjaan Sosial',
                "program_keahlian" => "Layanan Kesehatan",
                "konsentrasi_keahlian" => "Asisten Keperawatan dan Caregiver"
            ],
            [
                'code' => "BM1",
                "name" => "Bisnis dan Manajemen",
                "program_keahlian" => "Manajemen Perkantoran dan Layanan Bisnis",
                "konsentrasi_keahlian" => "Manajemen Perkantoran"
            ],
            [
                "code" => "AKL",
                "name" => "Bisnis dan Manajemen",
                "program_keahlian" => "Akutansi dan Keuangan Lembaga",
                "konsentrasi_keahlian" => "Akutansi Keuangan"
            ],

        ])->each(function($jurusan){
            Major::create($jurusan);
        });
    }
}
