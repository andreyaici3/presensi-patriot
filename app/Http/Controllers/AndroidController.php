<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Models\AkunGuru;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AndroidController extends Controller
{
    public function index()
    {
        $user = Guru::doesntHave('akun_guru')->orderBy('nama_guru', 'ASC')->get();
        return view('android.index', [
            'user' => $user,
            'akun' => AkunGuru::get(),
        ]);
    }

    public function store(Request $request){
        try {
            AkunGuru::create([
                'email' => $request->email,
                'password' => Hash::make('p4ssw0rd'),
            ]);
            return redirect()->to(route('android.index'))->with('success', "Akun Guru Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('android.index'))->with('gagal', "Akun Guru Gagal Ditambahkan");
        }
       
    }
}
