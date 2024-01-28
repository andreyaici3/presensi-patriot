<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use Carbon\Carbon;
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

    public function reportBulanan(Request $request)
    {
        if (isset($request->date)){
            $tanggalSekarang = $request->date;
        } else {
            $tanggalSekarang = date('Y-m-d');
        }
        
        // $tanggalSekarang = "2023-11-01";

        $dataAwalMinggu = $this->getMingguKeBerapa($tanggalSekarang);

        
        $seminggu = abs(5 * 86400);
        $awal = strtotime($dataAwalMinggu[0]);
        $akhir = strtotime(end($dataAwalMinggu)) + $seminggu;
        $guru = Guru::orderBy('kode_guru', 'ASC')->get();

        for ($i = $awal; $i <= $akhir; $i += 86400) {
            $date[] = date('d-m-Y', $i);
        }

        foreach ($guru as $value) {
            for ($i = $awal; $i <= $akhir; $i += 86400) {
                $value["jamSeluruhnya"] = $this->getJumlahJam($value->kode_guru) * 4;
                $value["jamTerpakai"] += $this->getDataAbsen(date('Y-m-d', $i), $value->kode_guru)->count();
            }
        }

        return view('report.bulanan', [
            'report' => $guru,
            'tanggal' => [
                'awal' => date('d-m-Y', $awal),
                'akhir' => date('d-m-Y', $akhir),
            ]
        ]);
    }

    public function reportHarian()
    {
        $format = date('Y-m-d');
        //getJumlahJamSkarang
        $dataHari = Hari::where('nama', Carbon::now()->isoFormat('dddd'))->first();


        $guru = Guru::orderBy('kode_guru', 'ASC')->get();
        foreach ($guru as $value) {
            $value["jamSeluruhnya"] = Jadwal::where("kode_guru", "=", $value->kode_guru)->where("id_hari", "=", $dataHari->id)->get()->count();
            $value["jamTerpakai"] += $this->getDataAbsen($format, $value->kode_guru)->count();
        }

        return view('report.harian', [
            'report' => $guru,
        ]);
    }

    public function reportMingguan(Request $request)
    {
        if (isset($request->date)){
            
            $tanggalSekarang = $request->date;
        } else {
            $tanggalSekarang = date('Y-m-d');
        }

        
        $guru = $this->getDataMingguan($tanggalSekarang);
       
        return view('report.mingguan', [
            'report' => $guru["guru"],
            'tanggal' => [
                'awal' => $guru["awal"],
                'akhir' => $guru["akhir"],
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

    public function exportPdfMingguan(Request $request){
     
        $guru = $this->getDataMingguan($request->date);


        return view('absen.report', [
            'report' => $guru["guru"],
            'tanggal' => [
                'awal' => $guru["awal"],
                'akhir' => $guru["akhir"],
            ]
        ]);
    }

    private function getDataMingguan($tanggalSekarang){
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
            }
        }

        return [
            "guru" =>  $guru,
            "awal" => date('d-m-Y', $awal),
            "akhir" => date('d-m-Y', $akhir),
        ];
    }
}
