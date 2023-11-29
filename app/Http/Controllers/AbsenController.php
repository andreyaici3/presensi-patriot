<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jadwal;
use DateTime;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        return view('absen.index', [
            'absensi' => Absensi::orderBy('id', "DESC")->get(),
            "no" => 1
        ]);
    }

    public function reportHarian()
    {
        $tanggals = [];
        $tahun = "2023";
        $bulan = "11";
        $tanggal = "27";
        $format = $tahun . '-' . $bulan . '-' . $tanggal;
        $seminggu = abs(6 * 86400);
        $awal = strtotime($format);
        $akhir = strtotime($format) + $seminggu;
        for ($i = $awal; $i <= $akhir; $i += 86400) {
            $tanggals[][date('Y-m-d', $i)][] = [
                "kode_guru" => "63",
                "jumlah_jam_terpakai" => $this->getDataAbsen(date('Y-m-d', $i), 63)->count(),
                "jumlah_jam_seharusnya" => ""
            ];
        }

        return $tanggals;
        // return $this->getJumlahJam(63);    
    }

    public function reportMingguan()
    {
        // $tanggalSekarang = date('Y-m-d');
        $tanggalSekarang = "2023-11-01";
        
        $dataAwalMinggu = $this->getMingguKeBerapa($tanggalSekarang);
        $tanggalAwal = null;
        foreach ($dataAwalMinggu as $value) {
            if ($tanggalSekarang >= $value)
                $tanggalAwal[] = $value;
        }

        if ($tanggalAwal == null) {
            $dateOneMonthAdded = strtotime(date("Y-m-d", strtotime($tanggalSekarang)) . "-1 month");
            $dataAwalMinggu = $this->getMingguKeBerapa(date('Y-m-d', $dateOneMonthAdded));
            $format = end($dataAwalMinggu);           
        } else {
            $format = end($tanggalAwal);
        }



        $seminggu = abs(5 * 86400);
        $awal = strtotime($format);
        $akhir = strtotime($format) + $seminggu;
        $guru = Guru::orderBy('kode_guru', 'ASC')->get();

        foreach ($guru as $value) {
            for ($i = $awal; $i <= $akhir; $i += 86400) {
                $value["jamSeluruhnya"] = $this->getJumlahJam($value->kode_guru);
                $value["jamTerpakai"] += $this->getDataAbsen(date('Y-m-d', $i), $value->kode_guru)->count();
                $tgl[] = date('Y-m-d', $i);
                $value["tanggal"] = $tgl; 
            }
        }

        return view('report.mingguan', [
            'report' => $guru,
            'tanggal' => [
                'awal' => date('d-m-Y', $awal),
                'akhir' => date('d-m-Y', $akhir),
            ]
        ]);
    }


    public function getMingguKeBerapa($tanggalSekarang)
    {
        $list = array();
        $exp = explode('-', $tanggalSekarang);
        $month = $exp[1];
        $year = $exp[0];

        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
                if (date('D', $time) == "Mon")
                    $list[] = date('Y-m-d', $time);
        }

        return $list;
    }







    private function getJumlahJam($kode_guru)
    {
        $jadwal = Guru::where('kode_guru', $kode_guru)->first()->jadwal->count();

        return $jadwal;
    }

    private function getDataAbsen($tanggal, $kode_guru)
    {
        return Absensi::whereDate('created_at', '=', $tanggal)->where([
            ['kode_guru', '=', $kode_guru],
            ["status_hadir", "=", 1]
        ])->get();
    }
}
