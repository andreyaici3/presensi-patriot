<?php

namespace App\Http\Controllers\Wakasek;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbsenStaff\StaffRequest;
use App\Models\Guru;
use Illuminate\Http\Request;

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
}
