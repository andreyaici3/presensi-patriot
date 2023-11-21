<?php

namespace Database\Seeders;

use App\Models\Hari;
use App\Models\MasterJadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //hari senin
        collect([
            [
                'jam_ke' => 1,
                'id_hari' => 1,
                'id_jam' => 3,
            ],
            [
                'jam_ke' => 2,
                'id_hari' => 1,
                'id_jam' => 4,
            ],
            [
                'jam_ke' => 3,
                'id_hari' => 1,
                'id_jam' => 6,
            ],
            [
                'jam_ke' => 4,
                'id_hari' => 1,
                'id_jam' => 7,
            ],
            [
                'jam_ke' => 5,
                'id_hari' => 1,
                'id_jam' => 8,
            ],
            [
                'jam_ke' => 6,
                'id_hari' => 1,
                'id_jam' => 10,
            ],
            [
                'jam_ke' => 7,
                'id_hari' => 1,
                'id_jam' => 12,
            ],
            [
                'jam_ke' => 8,
                'id_hari' => 1,
                'id_jam' => 15,
            ],
          
        ])->each(function($jadwal){
            MasterJadwal::create($jadwal);
        });

        //hari selasa
        collect([
            [
                'jam_ke' => 1,
                'id_hari' => 2,
                'id_jam' => 1,
            ],
            [
                'jam_ke' => 2,
                'id_hari' => 2,
                'id_jam' => 2,
            ],
            [
                'jam_ke' => 3,
                'id_hari' => 2,
                'id_jam' => 3,
            ],
            [
                'jam_ke' => 4,
                'id_hari' => 2,
                'id_jam' => 4,
            ],
            [
                'jam_ke' => 5,
                'id_hari' => 2,
                'id_jam' => 6,
            ],
            [
                'jam_ke' => 6,
                'id_hari' => 2,
                'id_jam' => 7,
            ],
            [
                'jam_ke' => 7,
                'id_hari' => 2,
                'id_jam' => 8,
            ],
            [
                'jam_ke' => 8,
                'id_hari' => 2,
                'id_jam' => 9,
            ],
            [
                'jam_ke' => 9,
                'id_hari' => 2,
                'id_jam' => 11,
            ],
            [
                'jam_ke' => 10,
                'id_hari' => 2,
                'id_jam' => 13,
            ],
            [
                'jam_ke' => 11,
                'id_hari' => 2,
                'id_jam' => 14,
            ],
          
        ])->each(function($jadwal){
            MasterJadwal::create($jadwal);
        });

        //hari rabu
        collect([
            [
                'jam_ke' => 1,
                'id_hari' => 3,
                'id_jam' => 1,
            ],
            [
                'jam_ke' => 2,
                'id_hari' => 3,
                'id_jam' => 2,
            ],
            [
                'jam_ke' => 3,
                'id_hari' => 3,
                'id_jam' => 3,
            ],
            [
                'jam_ke' => 4,
                'id_hari' => 3,
                'id_jam' => 4,
            ],
            [
                'jam_ke' => 5,
                'id_hari' => 3,
                'id_jam' => 6,
            ],
            [
                'jam_ke' => 6,
                'id_hari' => 3,
                'id_jam' => 7,
            ],
            [
                'jam_ke' => 7,
                'id_hari' => 3,
                'id_jam' => 8,
            ],
            [
                'jam_ke' => 8,
                'id_hari' => 3,
                'id_jam' => 10,
            ],
            [
                'jam_ke' => 9,
                'id_hari' => 3,
                'id_jam' => 12,
            ],
            [
                'jam_ke' => 10,
                'id_hari' => 3,
                'id_jam' => 15,
            ],
        ])->each(function($jadwal){
            MasterJadwal::create($jadwal);
        });


         //hari kamis
         collect([
            [
                'jam_ke' => 1,
                'id_hari' => 4,
                'id_jam' => 1,
            ],
            [
                'jam_ke' => 2,
                'id_hari' => 4,
                'id_jam' => 2,
            ],
            [
                'jam_ke' => 3,
                'id_hari' => 4,
                'id_jam' => 3,
            ],
            [
                'jam_ke' => 4,
                'id_hari' => 4,
                'id_jam' => 4,
            ],
            [
                'jam_ke' => 5,
                'id_hari' => 4,
                'id_jam' => 6,
            ],
            [
                'jam_ke' => 6,
                'id_hari' => 4,
                'id_jam' => 7,
            ],
            [
                'jam_ke' => 7,
                'id_hari' => 4,
                'id_jam' => 8,
            ],
            [
                'jam_ke' => 8,
                'id_hari' => 4,
                'id_jam' => 9,
            ],
            [
                'jam_ke' => 9,
                'id_hari' => 4,
                'id_jam' => 11,
            ],
            [
                'jam_ke' => 10,
                'id_hari' => 4,
                'id_jam' => 13,
            ],
            [
                'jam_ke' => 11,
                'id_hari' => 4,
                'id_jam' => 14,
            ],
          
        ])->each(function($jadwal){
            MasterJadwal::create($jadwal);
        });

         //hari jum'at
         collect([
            [
                'jam_ke' => 1,
                'id_hari' => 5,
                'id_jam' => 2,
            ],
            [
                'jam_ke' => 2,
                'id_hari' => 5,
                'id_jam' => 3,
            ],
            [
                'jam_ke' => 3,
                'id_hari' => 5,
                'id_jam' => 5,
            ],
            [
                'jam_ke' => 4,
                'id_hari' => 5,
                'id_jam' => 6,
            ],
            [
                'jam_ke' => 5,
                'id_hari' => 5,
                'id_jam' => 7,
            ],
            [
                'jam_ke' => 6,
                'id_hari' => 5,
                'id_jam' => 10,
            ],
            [
                'jam_ke' => 7,
                'id_hari' => 5,
                'id_jam' => 16,
            ],
            [
                'jam_ke' => 8,
                'id_hari' => 5,
                'id_jam' => 17,
            ],
           
           
           
          
        ])->each(function($jadwal){
            MasterJadwal::create($jadwal);
        });
    
    }
}
