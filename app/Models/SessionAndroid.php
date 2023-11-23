<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAndroid extends Model
{
    use HasFactory;

    protected $table = "session_android";
    protected $fillable = ["email", "user_agent", "mac_address", "device_name"];

    public function guru(){
        return $this->belongsTo(Guru::class,  "email");
    }
}
