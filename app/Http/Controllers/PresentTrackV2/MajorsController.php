<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTrackV2\MajorFormRequest;
use App\Models\Major;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    public function index(){
        return view('present-track-v2.modul.major.index', [
            'majors' => Major::get(),
        ]);
    }

    public function create(){
        return view('present-track-v2.modul.major.create');
    }

    public function store(MajorFormRequest $request){
        try {
            Major::create($request->all());
            return redirect()->to(route("manage.major"))->with("sukses", "Jurusan Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.major'))->withInput()->with('gagal', "Data Gagal Diitambahkan");
        }
    }

    public function edit($id){
        return view('present-track-v2.modul.major.edit', [
            'data' => Major::findOrFail($id)
        ]);
    }

    public function update(MajorFormRequest $request, $id){
        try {
            Major::findOrFail($id)->update($request->all());
            return back()->with("sukses", "Data Jurusan Berhasil Di Ubah");
        } catch (\Throwable $th) {
            return back()->withInput()->with("gagal", "Data Jurusan Gagal Diubah");
        }
    }

    public function destroy($id){
        try {
            Major::findOrfail($id)->delete();
            return redirect()->to(route('manage.major'))->with("sukses", "Data Jurusan Berhasil Di Hapus");
        } catch (QueryException $th) {
            return redirect()->to(route('manage.major'))->with("gagal", "Data Jurusan Gagal Dihapus");
        }
    }
}
