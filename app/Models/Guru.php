<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'master_guru';

    protected $guarded = [];

    public function jadwal(){
        return $this->hasMany(Jadwal::class, 'kode_guru', 'kode_guru');
    }

    public function absen(){
        return $this->hasMany(Absensi::class, 'kode_guru', 'kode_guru');
    }

    
}
