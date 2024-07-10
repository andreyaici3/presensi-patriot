<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class TeacherLogin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = ['teacher_id', 'password', 'device_token'];

    protected $hidden = [
        'password', 'device_token'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
