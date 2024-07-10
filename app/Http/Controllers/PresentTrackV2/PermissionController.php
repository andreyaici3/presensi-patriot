<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Schedulles;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends BaseController
{
    public function index(){
        return view('present-track-v2.staff.permission.index', [
            'permissions' => Permission::get(),
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'kode_guru' => 'required',
            'class_id' => 'required',
            "status" => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        $teacher = Teacher::where('kode_guru',$request->kode_guru)->first();
        if (!$teacher)
            return $this->sendError("Guru Tidak Terdaftar", 422);

        $day_id = Carbon::now()->dayOfWeekIso;
        $schedules = Schedulles::where('class_id', $request->class_id)
            ->where('teacher_id', $teacher->id)
            ->whereHas('timeSlot', function ($query) use ($day_id) {
                $query->where('day_id', $day_id);
            })
            ->get();

        if ($schedules->count() == 0)
            return $this->sendError("Jadwal Tidak Ditemukan", 422);

        $currentDate = Carbon::now();
        $data = [];
        foreach ($schedules as $key => $value) {
            $existingAbsensi = Attendance::where([
                ['teacher_id', '=', $value->teacher_id],
                ['schedule_id', '=', $value->id],
                ['class_id', '=', $value->class_id]
            ]);
            $existingAbsensi = $existingAbsensi->whereDate('attendance_time', $currentDate->toDateString())->first();

            if (!$existingAbsensi){
                $attendance = Attendance::create([
                    'teacher_id' => $value->teacher_id,
                    "schedule_id" => $value->id,
                    "academic_year_id" => AcademicYear::where('active', true)->first()->id,
                    'class_id' => $value->class_id,
                    'attendance_time' => now(),
                    'original_schedule_id' => $value->id,
                    'status' => 'need action'
                ]);

                $data[] = Permission::create([
                    'attendance_id' => $attendance->id,
                    'status' => $request->status,
                    'teacher_id' => $value->teacher_id,
                    'class_id' => $value->class_id
                ]);
            }
        }

        if (count($data) > 0){
            return $this->sendResponse($data, "Absen Sudah Dilakukan Menunggu Approval");
        } else {
            return $this->sendError("Kamu Sudah Melakukan Izin Untuk Jadwal Ini");
        }
    }

    public function accept($id){
        $permission = Permission::find($id);
        if (!$permission)
            return redirect()->to(route("manage.permission"))->with("gagal", "Izin Tidak Ditemukan");

        $allPermission = Permission::where([
                ['class_id', '=', $permission->class_id],
                ['teacher_id', '=', $permission->teacher_id]
            ]);

        foreach ($allPermission->get() as $key => $value) {
            Attendance::find($value->attendance_id)->update([
                'status' => $value->status
            ]);
        }

        $allPermission->delete();
        return redirect()->to(route("manage.permission"))->with("sukses", "Izin Guru Berhasil Di Terima");
    }

    public function destroy($id){
        $permission = Permission::find($id);
        if (!$permission)
            return redirect()->to(route("manage.permission"))->with("gagal", "Izin Tidak Ditemukan");

        $allPermission = Permission::where([
                ['class_id', '=', $permission->class_id],
                ['teacher_id', '=', $permission->teacher_id]
        ]);

        foreach ($allPermission->get() as $key => $value) {
            Attendance::find($value->attendance_id)->delete();
        }
        $allPermission->delete();
        return redirect()->to(route("manage.permission"))->with("sukses", "Izin Guru Ditolak");
    }
}
