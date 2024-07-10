<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'schedule_id',
        'academic_year_id',
        'attendance_time',
        'status',
        'class_id',
        'original_schedule_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedulles::class, 'schedule_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function originalSchedule()
    {
        return $this->belongsTo(Schedulles::class, 'original_schedule_id');
    }

    public function classes(){
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
