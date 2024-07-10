<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_id', 'status', 'class_id', 'teacher_id'];

    public function attendance(){
        return $this->belongsTo(Attendance::class, 'attendance_id');
    }
}
