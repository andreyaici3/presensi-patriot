<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $guarded = [];

    public function guru(){
        return $this->belongsTo(Guru::class, 'kode_guru', 'kode_guru');
    }

    public function master_jadwal()
    {
        return $this->belongsTo(MasterJadwal::class, 'id_jadwal');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    

    public function MJ(){
        return $this->belongsTo(MasterJadwal::class, 'id_jadwal');
    }

    public function mjs(){
        return $this->hasMany(MasterJadwal::class, 'id_jadwal');
    }

    
}
