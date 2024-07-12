<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTrackV2\ClassesFormRequest;
use App\Models\Classes;
use App\Models\Major;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClassController extends Controller
{
    public function index(){
        return view('present-track-v2.modul.class.index', [
            'class' => Classes::get(),
        ]);
    }

    public function create(){

        return view('present-track-v2.modul.class.create', [
            'major' => Major::get(),
        ]);
    }

    public function store(ClassesFormRequest $request){
        try {
            Classes::create($request->all());
            return redirect()->to(route("manage.class"))->with("sukses", "Data Kelas Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.class'))->withInput()->with('gagal', "Data Kelas Gagal Diitambahkan");
        }
    }

    public function edit($id){
        return view('present-track-v2.modul.class.edit', [
            'data' => Classes::findOrFail($id),
            'major' => Major::get(),

        ]);
    }

    public function update(ClassesFormRequest $request, $id){
        try {
            Classes::findOrFail($id)->update($request->all());
            return back()->with("sukses", "Data Kelas Berhasil Di Ubah");
        } catch (\Throwable $th) {
            return back()->withInput()->with("gagal", "Data Kelas Gagal Diubah");
        }
    }

    public function destroy($id){
        try {
            Classes::findOrfail($id)->delete();
            return redirect()->to(route('manage.class'))->with("sukses", "Data Kelas Berhasil Di Hapus");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.class'))->with("gagal", "Data Kelas Gagal Dihapus");
        }
    }

    public function generate($id){

        $class = Classes::findOrFail($id);
        QrCode::size(600)
                ->format('png')
                ->generate($class->id, public_path('pt-v2/assets/images/products/qrcode.png'));

        return view('present-track-v2.modul.class.generate', [
            'data' => $class,
        ]);
    }
}
