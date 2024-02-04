<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Models\AkunGuru;
use App\Models\Guru;
use App\Models\SessionAndroid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use PDO;

class AndroidController extends Controller
{
    public function index()
    {
        $user = Guru::doesntHave('akun_guru')->where("jabatan", "=", "guru")->orderBy('nama_guru', 'ASC')->get();

        return view('android.index', [
            'user' => $user,
            'akun' => AkunGuru::with('session_android')->whereHas("guru", function($query){
                return $query->where("jabatan", "guru");
            })->get(),
        ]);
    }

    public function store(Request $request)
    {
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

    public function reset($id)
    {
        $email = AkunGuru::find($id)->email;

        try {
            SessionAndroid::where('email', $email)->delete();
            return redirect()->to(route('android.index'))->with('success', "Akun Guru Berhasil DiReset");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('android.index'))->with('gagal', "Akun Guru Gagal DiReset");
        }
    }
}
