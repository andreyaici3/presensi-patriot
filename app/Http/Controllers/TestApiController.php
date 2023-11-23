<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Jam;
use App\Models\Kelas;
use App\Models\MasterJadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use PDO;

class TestApiController extends Controller
{
    public function assignJadwal(Request $request)
    {
        for ($i = 0; $i < count($request->input()); $i++) {
            $value = $request->input();
            $result =  Jadwal::create($value[$i]);
        }
        return response()->json($result, 200);
    }

    public function getJadwal(Request $request)
    {

        $kode_guru = $request->input('kode_guru');
        $id_hari = $request->input('id_hari');

        $jadwal = Jadwal::where([
            ['id_hari', '=', $id_hari],
            ['kode_guru', '=', $kode_guru]
        ])->get();

        for ($i = 0; $i < count($jadwal); $i++) {
            $jadwal[$i]['hari'] = Hari::firstWhere("id", $jadwal[$i]['id_hari']);
            $jadwal[$i]['jadwal'] = MasterJadwal::firstWhere("id", $jadwal[$i]['id_jadwal']);
            $jadwal[$i]['jam'] = Jam::firstWhere("id", $jadwal[$i]['id_jam']);
            $jadwal[$i]['kelas'] = Kelas::firstWhere("id", $jadwal[$i]['id_kelas']);
        }
        return response()->json($jadwal, 200);
    }

    public function absen(Request $request, $id)
    {
        $kode_guru = $request->input('kode_guru');
        // $id_kelas = $request->input('id_kelas');
        $id_kelas = $id;

        $dataHari = Hari::where('nama', Carbon::now()->isoFormat('dddd'))->first();

        $jadwal = Jadwal::where('id_kelas', "=", $id_kelas)->where("kode_guru", "=", $kode_guru)->where("id_hari", "=", $dataHari->id)->get();
        $counter = $jadwal->count();
        if ( $counter > 0) {
            $dataAbsen = Absensi::where('kode_guru', $kode_guru)->where('id_kelas', $id_kelas)->whereDate('created_at', "=", Carbon::today()->toDateString())->get();
            
            if ( $dataAbsen->count() < 1) {

                if (Carbon::now()->format('H:i:s') > $jadwal[0]->master_jadwal->jam->mulai) {
                    
                    for ($i=$counter; $i>0; $i--){

                        if (Carbon::now()->format('H:i:s') <  $jadwal[$i - 1]->master_jadwal->jam->selesai) {
                            $string = "Jam Ke - " . $jadwal[$i - 1]->master_jadwal->jam_ke . " Masuk Dikelas " . $jadwal[$i - 1]->kelas->nama_kelas . "-" . $jadwal[$i - 1]->kelas->jurusan->kode_jurusan . "-" . $jadwal[$i - 1]->kelas->rombel . " Pada " . Carbon::now()->isoFormat('dddd, D MMM Y') . " Pukul " . now()->format('H:i:s') . " WIB";

                            $data = [
                                "kode_guru" => $kode_guru,
                                'keterangan' => $string,
                                "status_hadir" => "1",
                                "id_kelas" => $id_kelas,
                            ];
                        } else {
                            $data = [
                                "kode_guru" => $kode_guru,
                                'keterangan' => "Jam Ke - " . $jadwal[$i - 1]->master_jadwal->jam_ke . " Dikelas ".$jadwal[$i - 1]->kelas->nama_kelas . "-" . $jadwal[$i - 1]->kelas->jurusan->kode_jurusan . "-" . $jadwal[$i - 1]->kelas->rombel . " Telat",
                                "status_hadir" => "0",
                                "id_kelas" => $id_kelas,
                            ];
                        }
                        $input = Absensi::create($data);
                        $arr[] = $input;
                        
                    }

                    $result = "Absen Berhasil Terimakasih";
                    
                }else{
                    $result = "Tenang, Anda Belum Masuk Jam Pelajaran, Sabar Ya Pak / Buk!!!";
                }                
            } else {
                $result = "Absen Gagal, Anda Sudah Absen Hari Ini";   
            }
        } else {
            // tidak ada absen
            $result = "Mohon Maaf Jadwal Bpk/Ibu Tidak Ditemukan Hari Ini";
        }

        $data = [
            "pesan" => $result,
            "result" => $arr ?? []
        ];

        return response()->json($data);
    }
}

