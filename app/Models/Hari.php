<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = "master_hari";
    protected $guarded = [];

    public function master_jadwal(){
        return $this->hasMany(MasterJadwal::class, 'id_hari');
    }
}
