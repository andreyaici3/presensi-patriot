<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportPerformaController extends BaseController
{
    public function mainFunction(Request $request)
    {
        $tanggalSekarang = date('Y-m-d');
        $data["report"] = [
            "harian" => $this->reportHarian($request->kode_guru, $tanggalSekarang),
            "mingguan" => $this->reportMingguan($request->kode_guru, $tanggalSekarang),
            "bulanan" => $this->reportBulanan($request->kode_guru, $tanggalSekarang),
        ];

        return $this->sendResponse($data, "Ambil Report Selesai");
        
    }

    //getReportHarian
    public function reportHarian($kode_guru, $tanggalSekarang)
    {
        $dataHari = Hari::where('nama', Carbon::parse($tanggalSekarang)->isoFormat('dddd'))->first();
        $kehadiran = $this->getDataAbsen($tanggalSekarang, $kode_guru)->count();
        $totalAbsen = Jadwal::where("kode_guru", "=", $kode_guru)->where("id_hari", "=", $dataHari->id)->get()->count();
        $data = [
            "tanggal" => $tanggalSekarang,
            "hari" => $dataHari->nama,
            "jamSeluruhnya" => $totalAbsen,
            "jamTerpakai" => $kehadiran,
            "prosentaseHadir" => ($kehadiran == 0) ? 0 : $kehadiran / $totalAbsen,
        ];
        return $data;
    }

    private function getDataAbsen($tanggal, $kode_guru)
    {
        return Absensi::whereDate('created_at', '=', $tanggal)->where([
            ['kode_guru', '=', $kode_guru],
            ["status_hadir", "=", 1]
        ])->get();
    }

    public function reportMingguan($kode_guru, $tanggalSekarang)
    {
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
        $report = [];
        $index = 0;
        $totalTerpakai = 0;
        $jamTertinggi = 0;

        for ($i = $awal; $i <= $akhir; $i += 86400) {
            $hari = Hari::where('nama', Carbon::parse(date('Y-m-d', $i))->isoFormat('dddd'))->first();
            $jmlJamDay = Jadwal::where("kode_guru", "=", $kode_guru)->where("id_hari", "=", $hari->id)->get()->count();
            $jmlAbsen = $this->getDataAbsen(date('Y-m-d', $i), $kode_guru)->count();
            $report[] = [
                "index" => $index++,
                "idHari" => $hari->id,
                "hari" => $hari->nama,
                "tanggal" => date('d-m-Y', $i),
                "jumlahAbsen" => $jmlAbsen,
            ];
            if ($jmlJamDay > $jamTertinggi) {
                $jamTertinggi = $jmlJamDay;
            }
            $totalTerpakai += $jmlAbsen;
        }

        $data = [
            "jamSeluruhnya" => $this->getJumlahJam($kode_guru),
            "jamTerpakai" => $totalTerpakai,
            "jamTerbanyak" => $jamTertinggi,
            'tanggalAwal' => date('d-m-Y', $awal),
            'tanggalAkhir' => date('d-m-Y', $akhir),
            "detailReport" => $report,

        ];

        return $data;
    }

    public function reportBulanan($kode_guru, $tanggalSekarang)
    {
        $dataAwalMinggu = $this->getMingguKeBerapa($tanggalSekarang);
        $seminggu = abs(5 * 86400);
        $awal = strtotime($dataAwalMinggu[0]);
        $akhir = strtotime(end($dataAwalMinggu)) + $seminggu;
        $totalTerpakai = 0;
        $index=0;
        $mingguKe = 1;
        foreach ($dataAwalMinggu as $value) {
            $minguan[] = $this->reportMingguan($kode_guru, $value);
        }
        
        $report = [];

        foreach ($minguan as $value){
            $report[] = [
                "index"=> $index++,
                "mingguKe" => $mingguKe++,
                "jamTerpakai" => $value["jamTerpakai"],
                
            ];
            $totalTerpakai += $value["jamTerpakai"];
        }
        
        $data = [
            "jamSeluruhnya" => $this->getJumlahJam($kode_guru) * 4,
            "jamTerpakai" => $totalTerpakai,
            'tanggalAwal' => date('d-m-Y', $awal),
            'tanggalAkhir' => date('d-m-Y', $akhir),
            "detailReport" => $report,

        ];

        return $data;
        
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
}
