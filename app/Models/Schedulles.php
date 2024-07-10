<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Schedulles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "schedules";

    protected $fillable = ["teacher_id", "subject_id", "class_id", "day_time_slot_id", "academic_year_id"];

    public function timeSlot()
    {
        return $this->belongsTo(TimesSlot::class, 'day_time_slot_id', 'id');
    }


    public function classes(){
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }


    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function attendance(){
        return $this->hasOne(Attendance::class, 'schedule_id');
    }


    public static function getSchedulles($id_class, $id_teacher){
        return self::where([
            ["class_id", '=', $id_class],
            ['teacher_id', '=', $id_teacher]
        ]);
    }

    public static function getSchedullesByToday($id_class, $id_teacher){

        $now = Carbon::now();
        $dayId = $now->isoWeekday();
        $query = self::where([
            ["class_id", '=', $id_class],
            ['teacher_id', '=', $id_teacher]
        ]);

        $query = $query->whereHas('timeSlot', function($query) use ($dayId) {
            $query->where('day_id', '=', $dayId);
        });

        return $query;


    }
}
