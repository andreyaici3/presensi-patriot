<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'kode_guru' => 63,
                "nik" => 3208102403010006,
                "nama_guru" => "Andrey Andriansyah, S.Kom", 
                "email" => "andreyandri90@gmail.com",
                "password" => md5(sha1("joya_123")),
                "blokir" => 0,
            ],
            [
                'kode_guru' => 64,
                "nik" => 3208102403010007,
                "nama_guru" => "Ahmad Nadlori, S.Kom", 
                "email" => "ahmad90@gmail.com",
                "password" => md5(sha1("joya_123")),
                "blokir" => 0,
            ],
        ])->each(function($guru){
            Guru::create($guru);
        });

       
    }
}
