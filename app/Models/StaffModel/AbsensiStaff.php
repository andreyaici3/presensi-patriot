<?php

namespace App\Models\StaffModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiStaff extends Model
{
    use HasFactory;
    protected $table = "absensi_staff";

    protected $fillable = ["kode_staff", "tanggal_absen", "hari", "absen_masuk", "jam_masuk", "absen_keluar", "jam_keluar"];
}
