<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        return view('guru.index',[
            'gurus' => Guru::get(),
            'urut' => 1,
        ]);
    }

    public function create(Request $request)
    {
        return view('guru.create');
    }

    public function store(Request $request){
        
        Guru::create([
            'kode_guru' =>  $request->kdGuru,
            'nik' => $request->nik,
            'nama_guru' => $request->nama,
            'email' => $request->email,
            'blokir' => 0,
        ]);

        return redirect('/guru');
    }

    public function edit($id)
    {
    
        return view('guru.edit',[
            'guru' => Guru::find($id)
        ]);
    }

    public function update(Request $request, $id){
        Guru::find($id)->update([
            'kode_guru' =>  $request->kdGuru,
            'nik' => $request->nik,
            'nama_guru' => $request->nama,
            'email' => $request->email,            
        ]);
        return redirect('/guru');
    }

    public function destroy($id)
    {
        Guru::find($id)->delete();
        return redirect('/guru');
    }
}

