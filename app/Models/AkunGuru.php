<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

class AkunGuru extends Model
{
    use HasFactory, HasApiTokens;

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
        return $this->belongsTo(SessionAndroid::class, 'email', 'email');
    }


}
