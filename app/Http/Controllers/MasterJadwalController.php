<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\MasterJadwal;
use Illuminate\Http\Request;

class MasterJadwalController extends Controller
{
    public function index()
    {
        return view('master-jadwal.index', [
            'jadwals' => MasterJadwal::class,
            'no'=> 1,
        ]);
    }

    public function kelola_jam($id){

        
        $master = MasterJadwal::where('id_hari',$id)->orderBy('jam_ke', 'ASC')->get();

        
        return view('master-jadwal.kelola-jam', [
            'hari' => Hari::where('id', $id)->first(),
            'jadwals' => $master,
            'no'=> 1,
        ]);
    }

    public function create($id){
        return view('master-jadwal.create', [
            'jams' => Jam::get(),
            'id' => $id
        ]);
    }

    public function store(Request $request, $id){
        MasterJadwal::create([
            'id_hari' => $id,
            'jam_ke' => $request->jam_ke,
            'id_jam' => $request->rentang_waktu
        ]);

        return redirect()->to("/hari/$id/kelola");
    }

    public function destroy($id){
        Jadwal::find($id)->delete();

        return redirect()->to("/jadwal");
    }
}
