<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunSiswa extends Model
{
    use HasFactory;
    protected $table = "akun_siswa";
    protected $fillable = ["email", "password", "blokir", "locked"];
}
