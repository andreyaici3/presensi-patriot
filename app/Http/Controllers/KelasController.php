<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('id_jurusan', "ASC")->get();

        return view('kelas.index', [
            'kelas' => $kelas,
            'no_urut' => 1,
        ]);
    }

    public function generate($id){
        return view('kelas.generate', [
            'kelas' => Kelas::find($id)
        ]);
    }

    public function create()
    {
        return view('kelas.create', [
            'jurusans' => Jurusan::get(),
        ]);
    }

    public function store(Request $request){
        Kelas::create([
            'id_jurusan' => $request->id_jurusan,
            'nama_kelas' => $request->nama_kelas,
            'rombel' => $request->rombel,
        ]);

        return redirect('/kelas');
    }

    public function edit(Request $request, $id)
    {
        

        $kelas = Kelas::where('kelas.id', $id)->join('jurusans', 'jurusans.id', '=', 'kelas.id_jurusan')
                        ->get('kelas.*', 'kelas.id AS kelasid', 'jurusan.*')
                        ->first();

       
        return view('kelas.edit', [
            'jurusans' => Jurusan::get(),
            'kelas' => $kelas
        ]);

        
    }

    public function update(Request $request, $id){

        
        Kelas::where('kelas.id', $id)->update([
            'id_jurusan' => $request->id_jurusan,
            'nama_kelas' => $request->nama_kelas,
            'rombel' => $request->rombel,
        ]);

        return redirect('/kelas');
    }

}
