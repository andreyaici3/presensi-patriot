<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Hari;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'nama' => "Senin",
            ],
            [
                'nama' => "Selasa",
            ],
            [
                'nama' => "Rabu",
            ],
            [
                'nama' => "Kamis",
            ],
            [
                'nama' => "Jumat",
            ],
            [
                'nama' => "Sabtu",
            ],
            [
                'nama' => "Minggu",
            ],
        ])->each( function($hari) {
            Hari::create($hari);
        });
    }
}
