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

class DashboardController extends Controller
{
    public function __invoke()
    {      
        $kelas = Kelas::orderBy('id_jurusan', "ASC")->get();
        date_default_timezone_set('Asia/Jakarta');
        foreach ($kelas as $value){
            $cek = $this->cekJamActive($value->id);
            $absensi = Absensi::where('id_kelas', $value->id)->whereDate("created_at", now()->format('Y-m-d'))->orderBy('created_at', 'DESC')->first();
            $time = date('h:i:s', $absensi != null ? strtotime($absensi->created_at) : null);
            // /$value["status"] =  $absensi;
            $value["status"] = $cek != null ? ($cek->mulai >= $time && $time <= $cek->selesai) : false;
            $value["guru"] = $value["status"] ? $absensi : null;
        }

  
        return view('dashboard', [
            'jurusan' => Jurusan::get(),
            'kelas' => $kelas,

        ]);

    }

    private function cekJamActive($id_kelas = null){
        date_default_timezone_set('Asia/Jakarta');
        $dataHari = Hari::where('nama', Carbon::now()->isoFormat('dddd'))->first();
        $jadwal = Jadwal::where('id_kelas', '=', $id_kelas)->where('id_hari', "=" ,$dataHari->id)->get();
        $currentTime = now()->format('H:i:s');

        foreach ($jadwal as $jd){
            $masterJadwal = MasterJadwal::where('master_jadwal.id_hari', '=', $dataHari->id)->where('id', "=",$jd->id_jadwal)->get();

            foreach ($masterJadwal as $row) {
                $jam = Jam::where([
                    ["id", "=", $row->id_jam],
                    ["mulai", "<=", $currentTime],
                    ["selesai", ">=", $currentTime],
                ])->first();
            }
        }
        
        return $jam ?? null;
    }
}
