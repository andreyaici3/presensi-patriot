<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTrackV2\TeacherFormRequest;
use App\Models\Guru;
use App\Models\Teacher;
use Illuminate\Database\QueryException;

class GuruV2Controller extends Controller
{
    public function index(){
        return view('present-track-v2.modul.guru.index', [
            'guru' => Teacher::orderBy('kode_guru', 'ASC')->get(),
        ]);
    }

    public function create(){
        return view('present-track-v2.modul.guru.create');
    }

    public function edit($id){
        return view('present-track-v2.modul.guru.edit', [
            'data' => Teacher::findOrFail($id)
        ]);
    }

    public function store(TeacherFormRequest $request){
        try {
            Teacher::addGuru($request);
            return back()->with("sukses", "Data Guru Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return back()->withInput()->with("gagal", "Data Guru Gagal Ditambahkan, Jangan Menguta atik form tanggal atau cek kolom lain untuk mencari tahu");
        }
    }

    public function update(TeacherFormRequest $request, $id){
        try {
            Teacher::updateGuru($request, $id);
            return back()->with("sukses", "Data Guru Berhasil Di Ubah");
        } catch (\Throwable $th) {
            return back()->withInput()->with("gagal", "Data Guru Gagal DiUbah, Jangan Menguta atik form tanggal atau cek kolom lain untuk mencari tahu");
        }
    }

    public function destroy($id){
        try {
            Teacher::findOrfail($id)->delete();
            return redirect()->to(route('manage.guru'))->with("sukses", "Data Guru Berhasil Di Hapus");
        } catch (QueryException $th) {
            return redirect()->to(route('manage.guru'))->with("gagal", "Data Guru Gagal Dihapus");
        }
    }
}
