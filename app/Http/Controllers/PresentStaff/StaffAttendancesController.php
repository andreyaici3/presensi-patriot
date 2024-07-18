<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\TelegramController;
use App\Models\AcademicYear;
use App\Models\StaffModel\Staff;
use App\Models\StaffModel\StaffAttendance;
use App\Services\FirebaseNotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StaffAttendancesController extends BaseController
{

    public function check(Request $request){
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 401);

        $staff = Staff::find($request->staff_id);

        if (!$staff)
            return $this->sendError("Staff Tidak Terdaftar", 404);

        $idStaff = $staff->id;

        $data = StaffAttendance::where([
            ['staff_id', '=', $idStaff],
        ]);
        $data = $data->whereDate('date', now());

        return $this->sendResponse($data->get()->first(), "Ambil Data Sukses");
    }
    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        $staff = Staff::find($request->staff_id);
        $type = ($request->type == -1 || $request->type == 0) ? true : false;

        if (!$staff)
            return $this->sendError('Staff Tidak Ditemukan', 404);

        if (!$type)
            return $this->sendError('Qr Code Tidak Terbaca / Salah, hub. Dev', 404);

        if ($request->type == 0){
            return $this->attendanceIn($staff);
        } else {
            return $this->attendanceOut($staff);
        }
    }


    public function attendanceOut($staff){
        Carbon::setLocale('id');
        $today = Carbon::now()->format('Y-m-d');
        $attendanceToday = StaffAttendance::where('staff_id', $staff->id)
            ->whereDate('created_at', $today)
            ->first();

        if (!$attendanceToday)
            return $this->sendError("Anda belum melakukan absen masuk hari ini.", 400);

        if ($attendanceToday->clock_out != null)
            return $this->sendError("Anda Sudah Melakukan Absen Keluar Hari Ini.", 400);

        $currentTime = Carbon::now();
        $startTime = Carbon::createFromTime(13, 0, 0); // Jam 13:00 (1 siang)
        $endTime = Carbon::createFromTime(16, 0, 0);   // Jam 16:00 (4 sore)

        if (!$currentTime->between($startTime, $endTime))
            return $this->sendError("Absen keluar hanya dapat dilakukan antara jam 13:00 sampai 16:00.", 400);

        $attendanceToday->clock_out = Carbon::now()->toTimeString();
        $str = $attendanceToday->notes . " & Absen Keluar Dilakukan Oleh User";
        $attendanceToday->notes = $str;
        $attendanceToday->save();

        return $this->sendResponse([], "Absen Kamu Berhasil, Selamat Ber Istirahat");
    }


    public function attendanceIn($staff){
        Carbon::setLocale('id');
        $today = Carbon::now()->format('Y-m-d');

        $attendanceToday = StaffAttendance::where('staff_id', $staff->id)
            ->whereDate('created_at', $today)
            ->first();

        if ($attendanceToday)
            return $this->sendError("Anda sudah melakukan absen masuk hari ini.", 400);

        // Periksa waktu absen masuk (contoh: antara jam 7 pagi sampai 11 siang)
        $currentTime = Carbon::now();
        $startTime = Carbon::createFromTime(7, 0, 0); // Jam 7 pagi
        $endTime = Carbon::createFromTime(11, 0, 0);   // Jam 11 siang

        if (!$currentTime->between($startTime, $endTime))
            return $this->sendError("Absen masuk hanya dapat dilakukan antara jam 7 pagi sampai 11 siang.", 400);

        try {
            $data = StaffAttendance::create([
                'staff_id' => $staff->id,
                'academic_year_id' => AcademicYear::where('active', true)->get()->first()->id,
                'date' => Carbon::now()->toDateString(),
                'clock_in'=> Carbon::now()->toTimeString(),
                'present' => true,
                'notes' => "Absen Masuk By User"
            ]);
            return $this->sendResponse($data, "Absen Kamu Berhasil, Selamat Bekerja");
        } catch (\Illuminate\Database\QueryException $th) {
            Log::error($th);
            return $this->sendError("Sepertinya ada yang salah");
        }
    }

    public function attendanceOutBySystem(){
        Carbon::setLocale('id');
        $today = Carbon::now()->format('Y-m-d');
        $attendanceToday = StaffAttendance::where('clock_out', null)
            ->whereDate('created_at', $today)
            ->get();

        $count = StaffAttendance::where('present', 1)
            ->whereDate('created_at', $today)
            ->get()->count();

        $str = "";
        foreach ($attendanceToday as $key => $value) {
            $value->clock_out = "14:00:00";
            $nts = $value->notes . " & Absen Keluar By System";
            $value->notes = $nts;
            $value->save();
            $str .= "👨‍🎓 <b>Nama Staff: </b>" . $value->staff->name . "\n";
            $str .= "⏰️ <b>Waktu Masuk: </b>" . $value->clock_in . "\n";
            $str .= "⏰️ <b>Waktu Keluar: </b>14:00:00 (By System)" . "\n";
            $str .= "🚀 <b>Catatan: </b>" . $value->notes . " & Absen Keluar By System \n";
            $str .= "\n";
            //data staff
            $token = $value->staff->login->device_token;
            $title = "ABSEN OTOMATIS";
            $content = "Sistem baru saja melakukan eksekusi absen kamu untuk absen keluar otomatis";
            $this->sendNotifApps($token, $title, $content);
        }

        if ($attendanceToday->count() > 0){
            $caption = "🚨  <i>SYSTEM OUT OTOMATIS ABSEN STAFF</i>  🚨

Sistem baru saja melakukan eksekusi untuk staff yang belum melakukan absen keluar

================================
Daftar Nama Staff
================================
$str================================
🚀 <b>Jumlah Staff Hadir Hari ini: </b> $count
⏰️ <b>Waktu Aktivitas: </b> " . Carbon::now()->format('d-m-Y H:i:s');

        } else {
            $caption = "🚨  <i>SYSTEM OUT OTOMATIS ABSEN STAFF</i>  🚨

Sistem baru saja melakukan eksekusi untuk staff yang belum melakukan absen keluar

Semua data Staff aman sudah melakukan absen keluar

🚀 <b>Jumlah Staff Hadir Hari ini: </b> $count
⏰️ <b>Waktu Aktivitas: </b> " . Carbon::now()->format('d-m-Y H:i:s');

$caption .= "\nSelamat Beristirahat\n\n";
        }

        $tg = new TelegramController();
        $tg->sendMessage(env('TELEGRAM_CHANNEL_ID'), $caption);
    }

    public function sendNotifApps($token, $title, $body){
        $firebaseService = new FirebaseNotificationService();

        // Kirim notifikasi ke token perangkat tertentu
        $firebaseService->sendNotification($token, $title, $body);
    }

}
