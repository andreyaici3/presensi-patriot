<?php

namespace App\Http\Controllers\SiswaController;

use App\Http\Controllers\Controller;
use App\Models\AkunSiswa;
use App\Models\MasterSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthSiswaController extends Controller
{
    public function register(){
        return view('siswa.auth.register');
    }

    public function store(Request $request){
        try {
            $tgl = explode("-",  $request->tanggal_lahir);
            $password = ucfirst(strtolower($request->tempat_lahir)) . $tgl[2]. $tgl[1] . $tgl[0];
            MasterSiswa::create([
                "nis" => $request->nis,
                "nama_siswa" => $request->nama_siswa,
                "tempat_lahir" => ucfirst(strtolower($request->tempat_lahir)),
                "tanggal_lahir" => $request->tanggal_lahir,
                "email" => $request->email,
                "no_hp" => $request->no_hp,
            ]);

            AkunSiswa::create([
                "email" => $request->email,
                "password" => Hash::make($password),
            ]);
            
            return redirect()->to(route('siswa.register'))->with('success', "Registration Success");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('siswa.register'))->with('gagal', "Registration Failed");
        }
    }
}
