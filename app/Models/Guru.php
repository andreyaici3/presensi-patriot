<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\NewAccessToken;


class Guru extends Model
{
    use HasFactory;

    protected $table = 'master_guru';

    protected $fillable = ["kode_guru", "nik", "nama_guru", "email", "jabatan"];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_guru', 'kode_guru');
    }

    public function absen()
    {
        return $this->hasMany(Absensi::class, 'kode_guru', 'kode_guru');
    }

    public function akun_guru(){
        return $this->hasOne(AkunGuru::class, 'email', 'email');
    }

    public function session_android(){
        return $this->hasOne(SessionAndroid::class, 'email', 'email');
    }

   
}
