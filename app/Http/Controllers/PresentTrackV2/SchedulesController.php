<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Day;
use App\Models\Major;
use App\Models\Schedulles;
use App\Models\Teacher;
use App\Models\TimesSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends BaseController
{
    public function index(Request $request){
        $days = $request->id_hari ? Day::where('id', $request->id_hari)->get() : [];
        $majors = Major::get();
        $teachers = Teacher::orderBy('kode_guru', 'ASC')->get();
        if ($days != []){
            $schedulles = $this->buildHtml($days[0], $majors, $teachers);
        } else {
            $schedulles = "";
        }
        return view('present-track-v2.akademik.jadwal.index', [
            'days' => $days,
            'majors' => $majors,
            'schedules' => $schedulles,
        ]);
    }

    public function buildHtml($day, $majors, $teachers){
        $str = "";
        $scheduleMap = [];
        $schedules = Schedulles::whereIn('day_time_slot_id', $day->timeSlots->pluck('id'))
                            ->get();
        foreach ($schedules as $schedule) {
            $scheduleMap[$schedule->day_time_slot_id][$schedule->class_id] = $schedule->teacher_id;
        }

        foreach ($day->timeSlots as $timeSlot) {
            $str .= "<tr>";
            $str .= "<td>$timeSlot->start_time - $timeSlot->end_time (Jam Ke: $timeSlot->jam_ke)</td>";
            foreach ($majors as $major) {
                foreach ($major->classes as $rombel) {
                    $str .= "<td>";
                    $str .= "<select id='slot-$timeSlot->id-class-$rombel->id' class='form-control change-schedulles' name='teacher_id[$timeSlot->id][$rombel->id]'>";
                    $str .= "<option value='init'>KD</option>";

                    foreach ($teachers as $teacher) {
                        $isSelected = isset($scheduleMap[$timeSlot->id][$rombel->id]) && $scheduleMap[$timeSlot->id][$rombel->id] == $teacher->id;
                        $selectedAttribute = $isSelected ? 'selected' : '';
                        $str .= "<option $selectedAttribute value='$teacher->id'>$teacher->kode_guru</option>";
                    }

                    $str .= "</select>";
                    $str .= "</td>";
                }
            }
            $str .= "</tr>";
        }

        return $str;


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
        $guru = Teacher::where('kode_guru', $request->kode_guru)->first();

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
            $sortedSchedules = $value->sortBy(function($schedule) {
                return Carbon::parse($schedule->timeSlot->start_time)->format('H:i');
            });

            $a = [];
            foreach ($sortedSchedules as $schedule) {
                if ($schedule->classes->grade == 'X'){
                    $ks = $schedule->classes->grade . "-" . $schedule->classes->major->program_keahlian_acronym . "-" . $schedule->classes->rombel_number;
                } else {
                    $ks = $schedule->classes->grade . "-" . $schedule->classes->major->konsentrasi_keahlian_acronym . "-" . $schedule->classes->rombel_number;
                }

                $a[] = "Jam Ke: " . $schedule->timeSlot->jam_ke . " : " . Carbon::parse($schedule->timeSlot->start_time)->format('H.i') . " - " . Carbon::parse($schedule->timeSlot->end_time)->format('H.i') . ": " . $ks;
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
            if ($schedule->classes->grade == 'X'){
                $className = $schedule->classes->grade . "-" . $schedule->classes->major->program_keahlian_acronym . "-" . $schedule->classes->rombel_number;
            } else {
                $className = $schedule->classes->grade . "-" . $schedule->classes->major->konsentrasi_keahlian_acronym . "-" . $schedule->classes->rombel_number;
            }

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
        $result = array_values($result);

        return $this->sendResponse($result, "Ambil Jadwal Hari Ini Selesai");
    }
}
