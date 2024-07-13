<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbsenStaff\StaffRequest;
use App\Models\StaffModel\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(){
        return view('present-staff.master.index', [
            'staffs' => Staff::get(),
        ]);
    }

    public function create(){
        return view('present-staff.master.create');
    }

    public function edit($id){
        return view('present-staff.master.edit', [
            'data' => Staff::findOrFail($id)
        ]);
    }

    public function store(StaffRequest $request){
        try {
            Staff::create($request->all());
            return redirect()->to(route('manage.staff'))->with("sukses", "Data Staff Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return back()->withInput()->with("gagal", "Data Staff Gagal Ditambahkan, Jangan Mengutak atik form tanggal atau cek kolom lain untuk mencari tahu");
        }
    }

    public function update(StaffRequest $request, $id){
        try {
            Staff::find($id)->update($request->all());
            return redirect()->to(route('manage.staff'))->with("sukses", "Data Staff Berhasil Diubah");
        } catch (\Illuminate\Database\QueryException $th) {
            return back()->withInput()->with("gagal", "Data Staff Gagal DiUbah, Jangan Mengutak atik form tanggal atau cek kolom lain untuk mencari tahu");
        }
    }

    public function destroy($id){
        try {
            Staff::findOrfail($id)->delete();
            return redirect()->to(route('manage.staff'))->with("sukses", "Data Staff Berhasil Di Hapus");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.staff'))->with("gagal", "Data Staff Gagal Dihapus");
        }
    }
}
