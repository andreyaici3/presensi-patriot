<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class AkunGuru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "akun_guru";

    protected $fillable = ["email", "password", "blokir", "locked"];

    protected $hidden = ["password"];

    public function createTokens(string $name)
    {
        $token = $this->createToken($name);
 
         return $token->plainTextToken;
    }

    public function guru(){
        return $this->belongsTo(Guru::class, 'email', 'email');
    }

    public function getToken(){
        return $this->tokens();
    }

    public function session_android(){
        return $this->hasOne(SessionAndroid::class, 'email', 'email');
    }


}
