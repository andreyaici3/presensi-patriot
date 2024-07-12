<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\TelegramController;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Day;
use App\Models\Schedulles;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendancesController extends BaseController
{
    public function attendance($classId, $kodeGuru){
        Carbon::setLocale('id');
        $currentDate = Carbon::now();
        $now = Carbon::parse($currentDate);
        $dayName = $currentDate->translatedFormat('l');
        $guru = Teacher::where('kode_guru', $kodeGuru)->first();
        $data = [];
        $result = [];

        if ($guru){
            $teacherId = $guru->id;
            $schedules = Schedulles::where('class_id', $classId)
                        ->where('teacher_id', $teacherId)
                        ->whereHas('timeSlot', function ($query) use ($dayName) {
                            $query->where('day_id', Day::where('name', $dayName)->first()->id);
                        })
                        ->with('timeSlot')
                        ->get()
                        ->sortBy(function ($schedule) {
                            return $schedule->timeSlot->jam_ke;
                        })->values()->all();

            $matchedIndex = null;
            foreach ($schedules as $index => $schedule) {
                $currentBatch[] = $schedule;
                if ($index === count($schedules) - 1 || $schedule->timeSlot->end_time !== $schedules[$index + 1]->timeSlot->start_time) {
                    $result[] = $currentBatch;
                    $currentBatch = [];
                }
            }

            foreach ($result as $index => $batch) {
                $start_time = Carbon::parse($batch[0]->timeSlot->start_time);
                $end_time = Carbon::parse(end($batch)->timeSlot->end_time);
                if ($now->between($start_time, $end_time)) {
                    $matchedIndex = $index;
                    break;
                }
            }

            if ($matchedIndex === null)
                return $this->sendError("Mohon Maaf Jadwal Tidak Ditemukan", 404);

            $cekLagi = true;
            $status = '';
            foreach ($result[$matchedIndex] as $key => $value) {
                if ($cekLagi){
                    $startTime = Carbon::parse($value->timeSlot->start_time);
                    $endTime = Carbon::parse($value->timeSlot->end_time);
                    if ($currentDate->between($startTime, $endTime)) {
                        $cekLagi = false;
                        $status = true;
                    } else {
                        $status = false;
                    }
                } else {
                    $status = true;
                }

                $attendance = [
                    "teacher_id" => $value->teacher_id,
                    "schedule_id" => $value->id,
                    "academic_year_id" => AcademicYear::where('active', 1)->first()->id,
                    "class_id" => $value->class_id,
                    "attendance_time" => Carbon::now(),
                    "status" => $status == true ? "present" : "late",
                    "original_schedule_id" => $value->id
                ];

                $existingAbsensi = Attendance::where([
                    ['teacher_id', '=', $value->teacher_id],
                    ['schedule_id', '=', $value->id],
                    ['class_id', '=', $value->class_id]
                ]);
                $existingAbsensi = $existingAbsensi->whereDate('attendance_time', $currentDate->toDateString())->first();

                if (!$existingAbsensi){
                    $data[] = Attendance::create($attendance);
                } else {
                    return $this->sendError("Anda Sudah Absen Hari Ini", 403);
                }
            }
            return $this->sendResponse($data, "Absensi Berhasil, Semangat Terus untuk mencerdaskan anak bangsa");
        } else {
            return $this->sendError("Data Tidak Ditemukan, Harap Hubungi Administrator", 403);
        }
    }

    public function fullPresent(){
        Carbon::setLocale('id');
        $currentDate = Carbon::now();
        $now = Carbon::parse($currentDate);
        $dayName = $currentDate->translatedFormat('l');
        $data = [];
        $result = [];
        $jam = 0;

        $schedules = Schedulles::whereHas('timeSlot', function ($query) use ($dayName) {
            $query->where('day_id', Day::where('name', $dayName)->first()->id);
        });

        foreach ($schedules->get() as $key => $value) {
            $existingAbsensi = Attendance::where([
                ['teacher_id', '=', $value->teacher_id],
                ['schedule_id', '=', $value->id],
                ['class_id', '=', $value->class_id]
            ]);
            $existingAbsensi = $existingAbsensi->whereDate('attendance_time', $currentDate->toDateString())->first();

            if (!$existingAbsensi){
                $data = [
                    "teacher_id" => $value->teacher_id,
                    "schedule_id" => $value->id,
                    "academic_year_id" => AcademicYear::where('active', 1)->first()->id,
                    "class_id" => $value->class_id,
                    "attendance_time" => Carbon::now(),
                    "status" => "present",
                    "original_schedule_id" => $value->id
                ];
                Attendance::create($data);
                $jam++;
            }
        }

        $tg = new TelegramController();
        $tgData = [
            'nama' => Auth::user()->name,
            'jam' => $jam,
            'waktu' => now()->format('d-m-Y H:i:s'),
        ];
        $tg->info_hari_llibur($tgData);

        return redirect()->to(route('manage.report.absenGuru'))->with("sukses", "$jam Jam Mengajar Berhasil Di Bypass");


    }

    public function attendaceOnDevice(Request $request){
        $validator = Validator::make($request->all(), [
            'class_id' => 'required',
            'kode_guru' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        return $this->attendance($request->class_id, $request->kode_guru);

    }

    public function checkAbsen(Request $request){
        $validator = Validator::make($request->all(), [
            'kode_guru' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);


        $dayOfWeek = Carbon::now()->dayOfWeek;
        $currentTime = Carbon::now()->toTimeString(); // Format "H:i:s"
        $kodeGuru = $request->kode_guru;
        // Mengambil data schedules hari ini berdasarkan day_id dan waktu sekarang
        $schedulesToday = Schedulles::whereHas('timeSlot', function ($query) use ($dayOfWeek, $currentTime) {
            $query->where('day_id', $dayOfWeek)
                    ->where('start_time', '<=', $currentTime)
                    ->where('end_time', '>=', $currentTime);
        })->whereHas('teacher', function ($query) use ($kodeGuru) {
            $query->where('kode_guru', $kodeGuru);
        })->first();

        // Menyimpan daftar absensi yang sudah ada hari ini untuk kode guru yang bersangkutan
        $attendanceToday = Attendance::where([
            ['teacher_id', '=', $schedulesToday->teacher_id ?? 0],
            ['class_id', '=', $schedulesToday->class_id ?? 0],
            ['schedule_id', '=', $schedulesToday->id ?? 0],
        ]);
        $attendanceToday = $attendanceToday->whereDate('attendance_time', Carbon::today()->toDateString());

        if ($schedulesToday){
            if ($attendanceToday->exists()){
                $statusAbsen = "Anda Sudah Absen";
            } else {
                $statusAbsen = "Belum Absen";
            }
        } else {
            $statusAbsen = "Tidak Perlu Absen";
        }

        return $this->sendResponse([
            "jamKe" => $schedulesToday ? "Jam Ke: " . $schedulesToday->timeSlot->jam_ke . " " . $schedulesToday->classes->grade . "-" . $schedulesToday->classes->major->code . "-" . $schedulesToday->classes->rombel_number: "Tidak Ada Jam Mengajar",
            "statusAbsen" => $statusAbsen,
        ], "Berhasil Ambil Data");
    }

    public function test(){

    }
}
