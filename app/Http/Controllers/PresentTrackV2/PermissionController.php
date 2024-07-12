<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\TelegramController;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Schedulles;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $jam_ke = "";
            foreach ($data as $key => $value) {
                $data = Permission::find($value->id);
                $jam_ke .= "Jam Ke " . $data->attendance->schedule->timeSlot->jam_ke . ", ";
                $nama = $data->attendance->teacher->first_name . " " . $data->attendance->teacher->last_name;
                $alasan = $value->status == "sick" ? 'SAKIT' : 'IZIN KEPERLUAN LAIN';
                $kelas = $data->attendance->classes->grade . "-" . $data->attendance->classes->major->code . "-" . $data->attendance->classes->rombel_number;
            }

            $tgData = [
                'nama' => $nama ?? '',
                'alasan' => $alasan ?? '',
                'jam_ke' => $jam_ke ?? '',
                'kelas' => $kelas ?? '',
                'waktu' => now()->format('d-m-Y H:i:s'),
            ];
            $tg = new TelegramController();
            $tg->info_request_izin($tgData);
            return $this->sendResponse($data, "Selesai, Menunggu Approval");
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

        $jam_ke = "";
        foreach ($allPermission->get() as $key => $value) {
            $data = Permission::find($value->id);
            $nama = $value->attendance->teacher->first_name . " " . $value->attendance->teacher->last_name;
            $alasan = $value->status == "sick" ? 'SAKIT' : 'IZIN KEPERLUAN LAIN';
            $jam_ke .= "Jam Ke " . $data->attendance->schedule->timeSlot->jam_ke . ", ";
            $kelas = $data->attendance->classes->grade . "-" . $data->attendance->classes->major->code . "-" . $data->attendance->classes->rombel_number;
            Attendance::find($value->attendance_id)->update([
                'status' => $value->status
            ]);
        }
        $allPermission->delete();
        $tgData = [
            'nama' => Auth::user()->name,
            'nama_guru' => $nama ?? '',
            'alasan' => $alasan ?? '',
            'waktu' => now()->format('d-m-Y H:i:s'),
            'jam_ke' => $jam_ke ?? '',
            'kelas' => $kelas ?? '',
        ];
        $tg = new TelegramController();
        $tg->info_acc_izin($tgData);
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

        $jam_ke = "";
        foreach ($allPermission->get() as $key => $value) {
            $data = Permission::find($value->id);
            $nama = $value->attendance->teacher->first_name . " " . $value->attendance->teacher->last_name;
            $alasan = $value->status == "sick" ? 'SAKIT' : 'IZIN KEPERLUAN LAIN';
            $jam_ke .= "Jam Ke " . $data->attendance->schedule->timeSlot->jam_ke . ", ";
            $kelas = $data->attendance->classes->grade . "-" . $data->attendance->classes->major->code . "-" . $data->attendance->classes->rombel_number;
            Attendance::find($value->attendance_id)->delete();
        }
        $allPermission->delete();

        $tgData = [
            'nama' => Auth::user()->name,
            'nama_guru' => $nama ?? '',
            'alasan' => $alasan ?? '',
            'waktu' => now()->format('d-m-Y H:i:s'),
            'jam_ke' => $jam_ke ?? '',
            'kelas' => $kelas ?? '',
        ];
        $tg = new TelegramController();
        $tg->info_reject_izin($tgData);
        return redirect()->to(route("manage.permission"))->with("sukses", "Izin Guru Ditolak");
    }
}
