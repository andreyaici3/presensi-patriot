<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJadwal extends Model
{
    use HasFactory;

    protected $table = 'master_jadwal';

    protected $guarded = [];

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'id_hari');
    }
    
    public function jam(){
        return $this->belongsTo(Jam::class, 'id_jam');
    }

    public function jadwal(){
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}
