<?php

namespace App\Http\Controllers\Wakasek;

use App\Http\Controllers\Controller;
use App\Models\StaffModel\AbsensiStaff;
use Illuminate\Http\Request;

class LogStaffController extends Controller
{
    public function index()
    {
        return view('absen-staff.log.index', [
            
            "absensi" => AbsensiStaff::get(),
        ]);
    }
}
