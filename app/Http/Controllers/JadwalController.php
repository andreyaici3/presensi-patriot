<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MasterJadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal.index', [
            'jadwal' => Jadwal::get(),
            'no' => 1
        ]);
    }

    public function filter($kode_guru)
    {
        return view('jadwal.index', [
            'jadwal' => Jadwal::where('kode_guru', $kode_guru)->get(),
            'no' => 1
        ]);
    }

    public function create()
    {
        return view('jadwal.choose', [
            'gurus' => Guru::get()
        ]);
    }

    public function storeJadwal(Request $request)
    {

        $guru = Guru::where('kode_guru', $request->kode_guru)->first();
        $jadwal = MasterJadwal::with('jam', 'hari')->get();
        $hari = Hari::get();
        $kelas = Kelas::with('jurusan')->get();
        $jam = Jam::get();

        return view('jadwal.create', compact("guru", "hari", "jadwal", "kelas", "jam"));
    }

    public function processStore(Request $request)
    {

        for ($i = 0; $i < count($request->input("id_jadwal")); $i++) {
            $req = [
                "kode_guru" => $request->input("kode_guru"),
                "id_jadwal" => $request->input("id_jadwal")[$i],
                "id_kelas" => $request->input("id_kelas")[$i],
                "id_hari" => $request->input("id_hari")[$i]
            ];
            Jadwal::create($req);
        }

        return redirect()->to("/jadwal");
    }

    

   

    public function destroy($id)
    {
        Jadwal::find($id)->delete();
        return redirect()->to("/jadwal");
    }
}
