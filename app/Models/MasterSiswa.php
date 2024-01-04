<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSiswa extends Model
{
    use HasFactory;
    protected $table = "master_siswa";
    protected $fillable = ["nis", "nama_siswa", "tanggal_lahir", "tempat_lahir", "email", "no_hp"];

}
