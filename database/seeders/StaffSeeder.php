<?php

namespace Database\Seeders;

use App\Models\StaffModel\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Ujang Rahman Nasutiar',
                'position' => 'Dapodik',
                'email' => 'ujang@gmail.com',
                'nip' => '1234567890'
            ],
            [
                'name' => 'Moh. Kiki Fiqri',
                'position' => 'Player',
                'email' => 'kiki@gmail.com',
                'nip' => '322245434543'
            ],
        ])->each(function($staff){
            Staff::create($staff);
        });
    }
}
