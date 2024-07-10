<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Day;
use App\Models\Major;
use App\Models\Schedulles;
use App\Models\Teacher;
use App\Models\TimesSlot;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends BaseController
{
    public function index(){

        return view('present-track-v2.akademik.jadwal.index', [
            'days' => Day::get(),
            'classes' => Classes::get(),
            'majors' => Major::get(),
            'timeSlots' => TimesSlot::get(),
            'schedules' => Schedulles::get(),
            'teachers' => Teacher::orderBy('kode_guru', 'ASC')->get(),
        ]);

    }

    public function saveChanges(Request $request){
        if($request->slot != null && $request->currentValue != null && $request->previous != null){
            //ini adalah ketika init menjadi previous nya brarti create jadwal baru
            $exp = explode("-", $request->slot);
            if($request->previous === "init"){
                try {
                    Schedulles::create([
                        'teacher_id' => $request->currentValue,
                        'subject_id' => null,
                        'class_id' => $exp[3],
                        'day_time_slot_id' => $exp[1],
                        'academic_year_id' => AcademicYear::where('active', 1)->first()->id
                    ]);
                    return true;
                } catch (\Illuminate\Database\QueryException $th) {
                    return false;
                }
            } else {

                $timeSlot = TimesSlot::findOrFail($exp[1]);
                $class = Classes::findOrFail($exp[3]);
                try {
                    $schedule = Schedulles::where([
                        ['class_id', '=', $class->id],
                        ['day_time_slot_id', '=', $timeSlot->id]
                    ]);

                    if ($request->currentValue === "init"){
                        $schedule->delete();
                        return true;
                    } else {
                        if ($schedule->first()){
                            $schedule->delete();
                            Schedulles::create([
                                'teacher_id' => $request->currentValue,
                                'subject_id' => null,
                                'class_id' => $exp[3],
                                'day_time_slot_id' => $exp[1],
                                'academic_year_id' => AcademicYear::where('active', 1)->first()->id
                            ]);
                        }
                        return true;
                    }
                } catch (\Illuminate\Database\QueryException $th) {
                    return false;
                }
            }

        }else {
            return false;
        }
    }

    public function getAllJadwal(Request $request){
        $guru = Teacher::where('kode_guru', $request->kode_guru)->firstOrFail();

        if (!$guru)
            return $this->sendError("Guru Tidak Terdaftar", 404);

        $schedules = $guru->schedules()
                    ->with('timeSlot')
                    ->get()
                    ->groupBy(function ($schedule) {
                        return $schedule->timeSlot->day_id;
                    });

        $data = [];
        $daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        foreach ($schedules as $key => $value) {
            // Urutkan jadwal berdasarkan waktu mulai
            $sortedSchedules = $value->sortBy(function($schedule) {
                return Carbon::parse($schedule->timeSlot->start_time)->format('H:i');
            });

            $a = [];
            foreach ($sortedSchedules as $schedule) {
                $a[] = "Jam Ke: " . $schedule->timeSlot->jam_ke . " : " . Carbon::parse($schedule->timeSlot->start_time)->format('H.i') . " - " . Carbon::parse($schedule->timeSlot->end_time)->format('H.i') . ": " . $schedule->classes->grade . "-" . $schedule->classes->major->code . "-" . $schedule->classes->rombel_number;
            }

            $data[Day::where('id', $key)->first()->name] = $a;
        }

        $sortedData = [];
        foreach ($daysOrder as $day) {
            if (isset($data[$day])) {
                $sortedData[$day] = $data[$day];
            }
        }

        return $this->sendResponse($sortedData, "Ambil Jadwal Berhasil");
    }

    public function getKelasByJadwal(Request $request){
        $validator = Validator::make($request->all(), [
            'kode_guru' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        $dayId = Carbon::now()->dayOfWeek; // Mengambil ID hari saat ini (0 = Minggu, 1 = Senin, ..., 6 = Sabtu)

        // Mengambil data teacher berdasarkan kode
        $teacher = Teacher::where('kode_guru', $request->kode_guru)->first();

        if (!$teacher)
            return $this->sendError("Guru Tidak Terdaftar", 404);

        $currentDate = Carbon::now()->toDateString();
        $schedules = $teacher->schedules()
            ->whereHas('timeSlot', function ($query) use ($dayId) {
                $query->where('day_id', $dayId);
            })
            ->whereDoesntHave('attendance', function ($query) use ($currentDate) {
                $query->whereDate('attendance_time', $currentDate);
            })
            ->with(['timeSlot', 'classes'])
            ->get();

        $result = [];

        foreach ($schedules as $schedule) {
            $classId = $schedule->classes->id;
            $className = $schedule->classes->grade . '-' . $schedule->classes->major->code . '-' . $schedule->classes->rombel_number;

            if (!isset($result[$classId])) {
                $result[$classId] = [
                    'id' => $classId,
                    'kelas' => $className,
                    'jadwal' => []
                ];
            }

            $result[$classId]['jadwal'][] = [
                'time_slot_id' => $schedule->timeSlot->id,
                'jam_ke' => $schedule->timeSlot->jam_ke,
                'start_time' => $schedule->timeSlot->start_time,
                'end_time' => $schedule->timeSlot->end_time,
                'day_id' => $schedule->timeSlot->day_id
            ];
        }

        // Mengonversi hasil ke array numerik
        $result = array_values($result);

        return $this->sendResponse($result, "Ambil Jadwal Hari Ini Selesai");
    }
}
