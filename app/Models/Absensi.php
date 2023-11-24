<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "absensi";

    protected $fillable = ["kode_guru", "keterangan", "status_hadir", "id_kelas", "nama_guru", "hari", "tanggal", "waktu_absen"];

    public function guru(){
        return $this->belongsTo(Guru::class, 'kode_guru', 'kode_guru');
    }
}
