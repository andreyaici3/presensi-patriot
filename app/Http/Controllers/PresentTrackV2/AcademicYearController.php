<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTrackV2\AcademicYearFormRequest;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(){
        return view("present-track-v2.superadmin.tahun-ajaran.index", [
            'academic' => AcademicYear::get()
        ]);
    }

    public function create(){
        return view("present-track-v2.superadmin.tahun-ajaran.create");
    }
    public function edit($id){
        return view("present-track-v2.superadmin.tahun-ajaran.edit", [
            'data' => AcademicYear::findOrFail($id)
        ]);
    }

    public function store(AcademicYearFormRequest $request){
        try {
            AcademicYear::create($request->all());
            return redirect()->to(route('manage.academic.year'))->with("sukses", "Data TA Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.academic.year.create'))->withInput()->with('gagal', "Data Gagal Ditambahkan");
        }
    }

    public function update(AcademicYearFormRequest $request, $id){
        try {
            AcademicYear::findOrFail($id)->update($request->all());
            return redirect()->to(route('manage.academic.year'))->with("sukses", "Data TA Berhasil Diubah");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.academic.year.create'))->withInput()->with('gagal', "Data Gagal Diubah");
        }
    }

    public function switchActive($id){

        try {
            $ta = AcademicYear::findOrFail($id);

            if ($ta->active != 1){

                AcademicYear::where('active', 1)->update([
                    'active' => 0
                ]);
                $ta->update([
                    'active' => 1
                ]);
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }

    }

    public function destroy($id){
        try {
            $ta = AcademicYear::findOrFail($id);
            if ($ta->active == 1)
                return redirect()->to(route('manage.academic.year'))->with('gagal', 'TA Sedang Aktif Tidak Bisa Dihapus');

            $ta->delete();
            return redirect()->to(route('manage.academic.year'))->with('sukses', 'TA Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->to(route('manage.academic.year'))->with('gagal', 'TA Gagal Dihapus');
        }

    }
}
