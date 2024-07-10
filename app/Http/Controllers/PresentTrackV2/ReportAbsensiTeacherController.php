<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Attendance;
use App\Models\Schedulles;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportAbsensiTeacherController extends BaseController
{
    public function index(){
        return view("present-track-v2.modul.report.absen-guru.index", [
            'report' => Attendance::orderBy('attendance_time', 'DESC')->get()
        ]);
    }

    public function reportHarian(){
        $dateToday = Carbon::today()->toDateString();
        $dayOfWeek = Carbon::now()->dayOfWeekIso;

        $attendanceData = Teacher::with([
            'attendances' => function($query) use ($dateToday) {
                $query->whereDate('attendance_time', $dateToday);
            },
            'schedules' => function($query) use ($dayOfWeek) {
                $query->whereHas('timeSlot', function($query) use ($dayOfWeek) {
                    $query->where('day_id', $dayOfWeek);
                });
            }
        ])->orderBy('kode_guru', 'ASC')->get();



        foreach ($attendanceData as $key => $value) {
            $summary = [
                "present" => 0,
                "late" => 0,
                "permission" => 0,
                "sick" => 0
            ];
            foreach ($value->attendances as $keys => $values) {
                if ($values->status == "present"){
                    $summary["present"] += 1;
                } else if ($values->status == "late"){
                    $summary["late"] += 1;
                } else if ($values->status == "permission"){
                    $summary["permission"] += 1;
                } else if ($values->status == "sick"){
                    $summary["sick"] += 1;
                }
            }
            $value["summary"] = $summary;
        }

        return view('present-track-v2.modul.report.absen-guru.harian', [
            'absen' => $attendanceData
        ]);
    }

    public function reportMinggan(Request $request){
        $targetDate = $request->date ?? date('Y-m-d');
        $startOfWeek = Carbon::parse($targetDate)->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::parse($targetDate)->endOfWeek(Carbon::FRIDAY);
        $dayOfWeek = Carbon::parse($targetDate)->dayOfWeekIso;


        $formattedStartOfWeek = $startOfWeek->translatedFormat('j F Y');
        $formattedEndOfWeek = $endOfWeek->translatedFormat('j F Y');

        $attendanceAndSchedulesData = Teacher::with([
            'attendances' => function($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('attendance_time', [$startOfWeek, $endOfWeek]);
            },
            'schedules' => function($query) use ($dayOfWeek) {
                $query->whereHas('timeSlot', function($query) use ($dayOfWeek) {
                    $query->whereBetween('day_id', [1, 5]);
                });
            }
        ])->orderBy('kode_guru', 'ASC')->get();

        foreach ($attendanceAndSchedulesData as $key => $value) {
            $summary = [
                "present" => 0,
                "late" => 0,
                "permission" => 0,
                "sick" => 0
            ];
            foreach ($value->attendances as $keys => $values) {
                if ($values->status == "present"){
                    $summary["present"] += 1;
                } else if ($values->status == "late"){
                    $summary["late"] += 1;
                } else if ($values->status == "permission"){
                    $summary["permission"] += 1;
                } else if ($values->status == "sick"){
                    $summary["sick"] += 1;
                }
            }
            $value["summary"] = $summary;
        }


        return view('present-track-v2.modul.report.absen-guru.mingguan', [
            'absen' => $attendanceAndSchedulesData,
            'rentang' => " {$formattedStartOfWeek} Sampai {$formattedEndOfWeek}",
        ]);
    }

    public function reportBulanan(Request $request){
        $targetMonth = $request->date ?? now();
        $startOfMonth = Carbon::parse($targetMonth)->startOfMonth();
        $endOfMonth = Carbon::parse($targetMonth)->endOfMonth();
        $numOfWeeks = $startOfMonth->diffInDays($endOfMonth) / 7;
        $firstMonday = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $lastFriday = $endOfMonth->copy()->endOfWeek(Carbon::FRIDAY);
        $formattedRange = $firstMonday->isoFormat('D MMMM YYYY') . ' sampai ' . $lastFriday->isoFormat('D MMMM YYYY');


        $attendanceAndSchedulesData = Teacher::with([
            'attendances' => function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('attendance_time', [$startOfMonth, $endOfMonth])
                    ->whereRaw('WEEKDAY(attendance_time) < 5');
            },
            'schedules' => function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereHas('timeSlot', function($query) {
                    $query->whereBetween('day_id', [1, 5]);
                })->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            }
        ])->orderBy('kode_guru', 'ASC')->get();

        foreach ($attendanceAndSchedulesData as $key => $value) {
            $summary = [
                "present" => 0,
                "late" => 0,
                "permission" => 0,
                "sick" => 0
            ];
            foreach ($value->attendances as $keys => $values) {
                if ($values->status == "present"){
                    $summary["present"] += 1;
                } else if ($values->status == "late"){
                    $summary["late"] += 1;
                } else if ($values->status == "permission"){
                    $summary["permission"] += 1;
                } else if ($values->status == "sick"){
                    $summary["sick"] += 1;
                }
            }
            $value["summary"] = $summary;
        }

        return view('present-track-v2.modul.report.absen-guru.bulanan', [
            'absen' => $attendanceAndSchedulesData,
            'rentang' => "{$formattedRange}",
            'jumlah_minggu' => ceil($numOfWeeks)
        ]);
    }

    public function performa(Request $request){
        $validator = Validator::make($request->all(), [
            'kode_guru' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        $guru = Teacher::where('kode_guru', $request->kode_guru)->first();
        if (!$guru)
            return $this->sendError("Guru Tidak Terdaftar");

        Carbon::setLocale('id');
        $currentDate = Carbon::now();
        $data = [
            "report" => [
                "harian" => $this->getHarianPerforma($request->kode_guru, $currentDate),
                "mingguan" => $this->getMingguanPerforma($request->kode_guru, $currentDate),
                "bulanan" => $this->getBulananPerforma($request->kode_guru, $currentDate),
            ]
        ];

        return $this->sendResponse($data, "Ambil Report Selesai");
    }


    private function getHarianPerforma($kodeGuru, $currentDate){
        $dayName = $currentDate->translatedFormat('l');
        $teacher = Teacher::where('kode_guru', $kodeGuru)->first();
        $teacherId = $teacher->id;
        $dayId = $currentDate->dayOfWeekIso;
        $timeSlotsCount = Schedulles::where('teacher_id', $teacherId)
            ->whereHas('timeSlot', function ($query) use ($dayId) {
                $query->where('day_id', $dayId);
            })
            ->count();

        $totalAttendanceCount = Attendance::where('teacher_id', $teacherId)
            ->whereDate('attendance_time', $currentDate)
            ->whereIn('status', ['present', 'sick'])
            ->count();

        $attendancePercentage = 0;
        if ($timeSlotsCount > 0) {
            $attendancePercentage = ($totalAttendanceCount / $timeSlotsCount) * 100;
            if ($attendancePercentage > 100){
                $attendancePercentage = number_format(100, '2');
            } else {
                $attendancePercentage = number_format($attendancePercentage, '2');
            }
        }


        return [
            "tanggal" => $currentDate->format("d-m-Y"),
            "hari" => $dayName,
            "jamSeluruhnya" => $timeSlotsCount,
            "jamTerpakai" => $totalAttendanceCount,
            "prosentaseHadir" => $attendancePercentage,
        ];

    }

    private function getMingguanPerforma($kodeGuru, $currentDate){
        $teacher = Teacher::where('kode_guru', $kodeGuru)->first();
        $teacherId = $teacher->id;
        $validDayIds = [1, 2, 3, 4, 5];
        $timeSlotsCount = Schedulles::where('teacher_id', $teacherId)
            ->whereHas('timeSlot', function ($query) use ($validDayIds) {
                $query->whereIn('day_id', $validDayIds);
            })
            ->count();
        $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::FRIDAY);
        $totalAttendanceCount = Attendance::where('teacher_id', $teacherId)
                ->whereBetween('attendance_time', [$startOfWeek->startOfDay(), $endOfWeek->endOfDay()])
                ->count();

        $dateList = [];
        $currentDate = $startOfWeek->copy();
        while ($currentDate->lte($endOfWeek)) {
            $formattedDate = $currentDate->format('d-m-Y');
            $dateList[] = $formattedDate;
            $currentDate->addDay();
        }

        $index = 0;
        foreach ($dateList as $key => $value) {
            $date = Carbon::createFromFormat('d-m-Y', $value);
            $detail[] = [
                "index" => $index++,
                "idHari" => $date->dayOfWeek,
                "detail" => $this->getHarianPerforma($kodeGuru, $date),
            ];
        }

        $modifiedData = collect($detail)->map(function ($item) {
            return [
                "index" => $item["index"],
                "idHari" => $item["idHari"],
                "tanggal" => $item["detail"]["tanggal"],
                "hari" => $item["detail"]["hari"],
                "jamSeluruhnya" => $item["detail"]["jamSeluruhnya"],
                "jamTerpakai" => $item["detail"]["jamTerpakai"],
                "prosentaseHadir" => $item["detail"]["prosentaseHadir"]
            ];
        });

        return [
            "jamSeluruhnya" => $timeSlotsCount,
            "jamTerpakai" => $totalAttendanceCount,
            "tanggalAwal" => $startOfWeek->format("d-m-Y"),
            "tanggalAkhir" => $endOfWeek->format("d-m-Y"),
            "detailReport" => $modifiedData
        ];


    }

    private function getBulananPerforma($kodeGuru, $currentDate){
        $teacher = Teacher::where('kode_guru', $kodeGuru)->first();
        $teacherId = $teacher->id;
        $validDayIds = [1, 2, 3, 4, 5];
        $currentDate = $currentDate->copy();
        $startOfMonth = Carbon::parse($currentDate)->startOfMonth();
        $endOfMonth = Carbon::parse($currentDate)->endOfMonth();
        $numOfWeeks = $startOfMonth->diffInDays($endOfMonth) / 7;
        $numOfWeeks = ceil($numOfWeeks);
        $firstMonday = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $lastFriday = $endOfMonth->copy()->endOfWeek(Carbon::FRIDAY);
        $dateRange = [];
        $currentDate = $firstMonday->copy();
        while ($currentDate->lte($lastFriday)) {
            if ($currentDate->dayOfWeek !== Carbon::SATURDAY && $currentDate->dayOfWeek !== Carbon::SUNDAY) {
                $dateRange[] = $currentDate->toDateString();
            }
            $currentDate->addDay();
        }

        $chunks = [];
        $totalElements = count($dateRange);
        for ($i = 0; $i < $totalElements; $i += 5) {
            $chunks[] = array_slice($dateRange, $i, 5);
        }

        $timeSlotsCount = Schedulles::where('teacher_id', $teacherId)
            ->whereHas('timeSlot', function ($query) use ($validDayIds) {
                $query->whereIn('day_id', $validDayIds);
            })
            ->count() * $numOfWeeks;

        $totalAttendanceCount = Attendance::where('teacher_id', $teacherId)
            ->whereBetween('attendance_time', [$firstMonday->startOfDay(), $lastFriday->endOfDay()])
            ->count();

        $detail = [];
        $idx = 0;
        foreach ($chunks as $key => $value) {
            $totalTerpakai = 0;
            $totalJam = 0;
            foreach ($value as $keys => $values) {

                $totalTerpakai = $totalTerpakai + Attendance::where('teacher_id', $teacherId)
                        ->whereDate('attendance_time', $values)
                        ->whereIn('status', ['present', 'sick'])
                        ->count();

                $dayId = Carbon::parse($values)->dayOfWeekIso;
                $totalJam = $totalJam + Schedulles::where('teacher_id', $teacherId)
                        ->whereHas('timeSlot', function ($query) use ($dayId) {
                            $query->where('day_id', $dayId);
                        })
                        ->count();
            }
            $attendancePercentage = 0;
            if ($totalTerpakai > 0) {
                $attendancePercentage = ($totalTerpakai / $totalJam) * 100;
                if ($attendancePercentage > 100){
                    $attendancePercentage = number_format(100, '2');
                } else {
                    $attendancePercentage = number_format($attendancePercentage, '2');
                }
            }
            $detail[] = [
                "index" => $idx++,
                "mingguKe" => ($idx),
                "jamTerpakai" => $totalTerpakai,
                "totalJam" => $totalJam,
                "prosentaseHadir" => $attendancePercentage,
            ];
        }


        $attendancePercentage = 0;
        if ($timeSlotsCount > 0) {
            $attendancePercentage = ($totalAttendanceCount / $timeSlotsCount) * 100;
            if ($attendancePercentage > 100){
                $attendancePercentage = number_format(100, '2');
            } else {
                $attendancePercentage = number_format($attendancePercentage, '2');
            }
        }


        return [
            "tanggalAwal" => Carbon::parse($dateRange[0])->format("d-m-Y"),
            "tanggalAkhir" => Carbon::parse($dateRange[count($dateRange)-1])->format('d-m-Y'),
            "jamSeluruhnya" => $timeSlotsCount,
            "jamTerpakai" => $totalAttendanceCount,
            "prosentaseHadir" => $attendancePercentage,
            "detailReport" => $detail,
        ];

    }
}
