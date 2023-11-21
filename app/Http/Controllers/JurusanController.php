<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        return view('jurusan.index', [
            'jurusans' => Jurusan::get(),
            'no_urut' => 1,
        ]);
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        Jurusan::create([
            'kode_jurusan' => $request->kdJurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect('/jurusan');
    }

    public function edit($id)
    {
        return view('jurusan.edit', [
            'jurusan' => Jurusan::find($id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        Jurusan::find($id)->update([
            'kode_jurusan' => $request->kdJurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect('/jurusan');
    }

    public function destroy($id)
    {
        Jurusan::find($id)->delete();

        return redirect('/jurusan');
    }
}
