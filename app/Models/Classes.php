<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['grade', 'major_id', 'rombel_number'];

    public function major(){
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function scheduless(){
        return $this->hasMany(Schedulles::class, 'class_id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'class_id');
    }
}
