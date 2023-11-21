<?php

namespace Database\Seeders;

use App\Models\Jam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //untuk hari senin
        collect([
            [
                'mulai' => '07:00:00',
                'selesai' => '07:40:00',
            ],
            [
                'mulai' => '07:40:00',
                'selesai' => '08:20:00',
            ],
            [
                'mulai' => '08:20:00',
                'selesai' => '09:00:00',
            ],
            [
                'mulai' => '09:00:00',
                'selesai' => '09:40:00',
            ],
            [
                'mulai' => '09:20:00',
                'selesai' => '10:00:00',
            ],
            [
                'mulai' => '10:00:00',
                'selesai' => '10:40:00',
            ],
            [
                'mulai' => '10:40:00',
                'selesai' => '11:20:00',
            ],
            [
                'mulai' => '11:20:00',
                'selesai' => '12:00:00',
            ],
            [
                'mulai' => '12:40:00',
                'selesai' => '13:15:00',
            ],
            [
                'mulai' => '13:00:00',
                'selesai' => '13:40:00',
            ],
            [
                'mulai' => '13:15:00',
                'selesai' => '13:50:00',
            ],
            [
                'mulai' => '13:40:00',
                'selesai' => '14:20:00',
            ],
            [
                'mulai' => '13:50:00',
                'selesai' => '14:25:00',
            ],
            [
                'mulai' => '14:25:00',
                'selesai' => '15:00:00',
            ],
            [
                'mulai' => '14:20:00',
                'selesai' => '15:00:00',
            ],
            [
                'mulai' => '13:20:00',
                'selesai' => '14:00:00',
            ],
            [
                'mulai' => '14:00:00',
                'selesai' => '14:40:00',
            ]
        ])->each(function($master){
            Jam::create($master);
        });

       
    }
}
