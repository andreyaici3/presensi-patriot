<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        return view('absen.index', [
            'absensi' => Absensi::orderBy('id', "DESC")->get(),
            "no" => 1
        ]);
    }
}
