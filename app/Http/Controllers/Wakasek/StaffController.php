<?php

namespace App\Http\Controllers\Wakasek;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbsenStaff\StaffRequest;
use App\Models\AkunGuru;
use App\Models\Guru;
use App\Models\SessionAndroid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        return view('absen-staff.master.index',[
            'staffs' => Guru::where("jabatan", "staff")->get(),
        ]);
    }

    public function create()
    {
        return view("absen-staff.master.create");
    }

    public function store(StaffRequest $request)
    {
        Guru::create([
            "kode_guru" => $request->kdStaff,
            "nik" => $request->nik,
            "nama_guru" => $request->nama,
            "email" => $request->email,
            "jabatan" => "staff",
        ]);
        return redirect()->to(route('wakasek.staff'))->with("sukses", "Staff Berhasil Ditambahkan");
    }

    public function edit($idStaff){
        return view("absen-staff.master.edit", [
            "staff" => Guru::find($idStaff),
        ]);
    }

    public function update(StaffRequest $request, $idStaff)
    {
        Guru::find($idStaff)->update([
            "kode_guru" => $request->kdStaff,
            "nik" => $request->nik,
            "nama_guru" => $request->nama,
        ]);
        return redirect()->to(route('wakasek.staff'))->with("sukses", "Data Staff Berhasil DiUbah");
    }

    public function destroy($idStaff){
        try {
            Guru::find($idStaff)->delete();
            return redirect()->to(route("wakasek.staff"))->with("sukses", "Data Staff Berhasil Di Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route("wakasek.staff"))->with("gagal", "Data Staff Gagal Dihapus");
        }
    }

    public function akun()
    {
        $user = Guru::doesntHave('akun_guru')->where("jabatan", "=", "staff")->orderBy('nama_guru', 'ASC')->get();
        
        return view('absen-staff.akun.index', [
            'user' => $user,
            'akun' => AkunGuru::with('session_android')->whereHas("guru", function($query){
                return $query->where("jabatan", "staff");
            })->get(),
        ]);
    }

    public function destroyAkun($id_akun)
    {
        try {
            $akun = AkunGuru::find($id_akun);
            $session = SessionAndroid::whereEmail($akun->email);
            if ($session->count())
                $session->delete();
            $akun->delete();
            return redirect()->to(route("wakasek.staff.akun"))->with("sukses", "Data Akun Staff Berhasil Di Hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route("wakasek.staff.akun"))->with("gagal", "Data Akun Staff Gagal Dihapus");
        }
    }

    public function createAkun(Request $request)
    {
        try {
            AkunGuru::create([
                'email' => $request->email,
                'password' => Hash::make('p4ssw0rd'),
            ]);
            return redirect()->to(route("wakasek.staff.akun"))->with("sukses", "Data Akun Staff Berhasil Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route("wakasek.staff.akun"))->with("gagal", "Data Akun Staff Gagal Ditambahkan");
        }
    }

}
