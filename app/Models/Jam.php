<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;
    protected $table = 'master_jam';

    protected $guarded = [];

    public function master_jadwal(){
        return $this->hasOne(MasterJadwal::class, 'id_jam');
    }
}
