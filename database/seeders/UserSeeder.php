<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => "Andrey Andriansyah",
                'email' => "andreyandri90@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make("joya_123"),
                'remember_token' => Str::random(10),
                'role' => 'superuser'
            ],
            [
                'name' => "Ahmad Nadlori",
                'email' => "ahmadnadlori8@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('1sampai8*'),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ],
            [
                'name' => "Staff 1",
                'email' => "staff1@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('staff1*ok*'),
                'remember_token' => Str::random(10),
                'role' => 'staff',
            ],

        ])->each(function($user){
            User::create($user);
        });
    }
}
