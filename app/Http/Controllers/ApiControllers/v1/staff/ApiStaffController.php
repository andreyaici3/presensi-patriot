<?php

namespace App\Http\Controllers\ApiControllers\v1\staff;

use App\Http\Controllers\Api\BaseController;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\SessionAndroid;
use App\Models\StaffModel\AbsensiStaff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ApiStaffController extends BaseController
{
    public function login(Request $request)
    {
        $dataGuru = Guru::has("akun_guru")->where([
            ["jabatan", "=", "staff"],
            ["email", "=", $request->email]
        ])->first();


        if ($dataGuru == null) {
            return $this->sendError("Silahkan Periksa Kembali Username / Password", 403);
        } else {
            if (!Hash::check($request->password, $dataGuru->akun_guru->password)) {
                return $this->sendError("Silahkan Periksa Kembali Username / Password", 403);
            } else {
                if ($dataGuru->akun_guru->blokir == 1) {
                    return $this->sendError("Akun Anda Terblokir, Hubungi Admin", 403);
                } else {
                    if ($dataGuru->session_android) {
                        if ($dataGuru->session_android->mac_address != $request->XMAC) {
                            return $this->sendError("Anda Terdeteksi Login Diperangkat Baru", 403);
                        } else {
                            //remove sesion lama
                            DB::table('personal_access_tokens')->where("tokenable_id", "=", $dataGuru->akun_guru->id)->delete();
                            $success['token'] =  $dataGuru->akun_guru->createToken('AppLogin', ['absen'])->plainTextToken;
                            $success["user"] = Guru::where('email', $dataGuru->email)->first();
                            return $this->sendResponse($success, 'User login successfully.');
                        }
                    } else {
                        $insert = SessionAndroid::create([
                            "email" => $request->email,
                            "user_agent" => $request->XUA,
                            "mac_address" => $request->XMAC,
                            "device_name" => $request->XNAME,
                        ]);
                        if ($insert) {
                            $dataGuru->akun_guru->update([
                                "locked" => 1
                            ]);
                            $success['token'] =  $dataGuru->akun_guru->createToken('AppLogin', ['absen'])->plainTextToken;
                            $success["user"] = Guru::where('email', $dataGuru->email)->first();
                            return $this->sendResponse($success, 'User login successfully.');
                        }
                    }
                }
            }
        }
    }

    public function absen(Request $request, $type = "masuk")
    {
        $kode_staff = $request->input('kode_staff');
        $dataHari = Hari::where('nama', Carbon::now()->isoFormat('dddd'))->first();
        $dataHari->nama = "Senin";
        if ($dataHari->nama == "Minggu" || $dataHari->nama == "Sabtu") {
            return $this->sendError("Sabtu Dan Minggu Tidak Bisa Absen");
        } else {
            $cekAbsensi = AbsensiStaff::where("kode_staff", "=", $kode_staff);
            if ($type == "masuk"){
                if ($cekAbsensi->count() > 0) {
                    return $this->sendError("Bpk / Ibu Sudah Absen Hari Ini", 403);
                } else {
                    $absen = AbsensiStaff::create(
                        [
                            "kode_staff"    => $kode_staff,
                            "tanggal_absen" => Carbon::now()->isoFormat('DD MMMM Y'),
                            "hari" => $dataHari->nama,
                            "absen_masuk" => 1,
                            "jam_masuk" => now()->format('H:i:s')
                        ]
                    );
                    return $this->sendResponse($absen, "Absen Berhasil");
                }
            } else if ($type == "keluar") {
                if ($cekAbsensi->count() < 0){
                    return $this->sendError("Silahkan Absen Masuk Terlebih Dahulu", 403);
                } else {
                    if ($cekAbsensi->first()->absen_keluar == 1){
                        return $this->sendError("Anda Sudah Absen Pulang Hari Ini", 403);
                    } else {
                        $cekAbsensi->update([
                            "absen_keluar" => 1,
                            "jam_keluar" => now()->format('H:i:s')
                        ]);
    
                        return $this->sendResponse(null, "Terimakasih, Sampai Jumpa Dan Selamat Beristirahat");
                    }
                }
            } else {
                return $this->sendError("Barcode Yang Anda Scan Tidak Sesuai", 404);
            }
        }
    }
}
