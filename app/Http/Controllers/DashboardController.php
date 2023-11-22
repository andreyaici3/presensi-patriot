<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MasterJadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {      
        $kelas = Kelas::orderBy('id_jurusan', "ASC")->get();
        
        foreach ($kelas as $value){
            $cek = $this->cekJamActive($value->id);
            $absensi = Absensi::where('id_kelas', $value->id)->whereDate("created_at", now()->format('Y-m-d'))->orderBy('created_at', 'DESC')->first();
            $time = $absensi != null ? Carbon::parse($absensi->created_at)->format("H:i:s") :null ;
            $value["status"] = $cek != null ? ($time >= $cek->mulai && $time <= $cek->selesai) : false;
        }

        return view('dashboard', [
            'jurusan' => Jurusan::get(),
            'kelas' => $kelas,

        ]);

    }

    private function cekJamActive($id_kelas = null){
        
        
        $dataHari = Hari::where('nama', Carbon::now()->isoFormat('dddd'))->first();
        $jadwal = Jadwal::where('id_kelas', '=', $id_kelas)->where('id_hari', "=" ,$dataHari->id)->get();
        $currentTime = now()->format('H:i:s');
    
        foreach ($jadwal as $jd){
            $masterJadwal = MasterJadwal::where('id_hari', '=', $dataHari->id)->where('id', "=",$jd->id_jadwal)->get();

            foreach ($masterJadwal as $row) {                
                $data = Jam::where("id", "=", $row->id_jam)->whereBetweenColumns(DB::raw("'$currentTime'"), ['mulai', 'selesai'])->first();
                if ($data){
                    $jam = $data;
                }
            }
        }   
        
        return $jam ?? null;
    }
}
