<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTrackV2\SubjectFormRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsControler extends Controller
{
    public function index(){
        return view('present-track-v2.akademik.mapel.index', [
            'subjects' => Subject::get(),
        ]);
    }

    public function create(){
        return view('present-track-v2.akademik.mapel.create');
    }

    public function store(SubjectFormRequest $request){
        try {
            Subject::create($request->all());
            return redirect()->to(route("manage.subject"))->with("sukses", "Mata Pelajaran Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.subject'))->withInput()->with('gagal', "Mata pelajaran Gagal Ditambahkan");
        }
    }

    public function edit($id){
        return view('present-track-v2.akademik.mapel.edit', [
            'data' => Subject::findOrFail($id)
        ]);
    }

    public function update(SubjectFormRequest $request, $id){
        try {
            Subject::findOrFail($id)->update($request->all());
            return back()->with("sukses", "Mata Pelajaran Berhasil Di Ubah");
        } catch (\Throwable $th) {
            return back()->withInput()->with("gagal", "Mata Pelajaran Gagal Diubah");
        }
    }

    public function destroy($id){
        try {
            Subject::findOrfail($id)->delete();
            return redirect()->to(route('manage.subjet'))->with("sukses", "Data Jurusan Berhasil Di Hapus");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.subjet'))->with("gagal", "Data Jurusan Gagal Dihapus");
        }
    }
}
