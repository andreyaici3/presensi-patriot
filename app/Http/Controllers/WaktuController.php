<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use \App\Models\Jam;
use App\Models\MasterJadwal;
use Illuminate\Http\Request;
use PDO;

class WaktuController extends Controller
{
    public function index(Request $request)
    {
        
        return view('waktu.index', [
            'jam' => Jam::get(),
            'nomor' => 1,
        ]);
    }

    public function create()
    {
        return view('waktu.create');
    }

    public function store(Request $request)
    {

        Jam::create([
            'mulai' => $request->mulai,
            "selesai" => $request->selesai,
        ]);

        return redirect('/waktu');
    }

    public function update(Request $request, $id){
        Jam::find($id)->update([
            'mulai' => $request->mulai,
            "selesai" => $request->selesai,
        ]);

        return redirect('/waktu');
    }

    public function edit($id){
        
        $waktu = Jam::find($id);

        
        return view('waktu.edit', [
            'jam' => $waktu
        ]);
    }

    public function destroy($id){
        MasterJadwal::where('id',$id)->delete();
        return redirect('/waktu');
    }
}
