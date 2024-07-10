<?php

namespace Database\Seeders;

use App\Models\Schedulles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                "teacher_id" => 17,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 1,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 17,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 2,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 17,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 3,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 18,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 4,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 18,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 5,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 10,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 6,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 10,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 7,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 10,
                "subject_id" => NULL,
                "class_id" => 1,
                "day_time_slot_id" => 8,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 18,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 1,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 18,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 2,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 19,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 3,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 19,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 4,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 23,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 5,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 23,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 6,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 23,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 7,
                "academic_year_id" => 1
            ],
            [
                "teacher_id" => 23,
                "subject_id" => NULL,
                "class_id" => 2,
                "day_time_slot_id" => 8,
                "academic_year_id" => 1
            ],
        ])->each(function($sch){
            Schedulles::create($sch);
        });
    }
}
