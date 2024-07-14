<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\StaffModel\Staff;
use App\Models\StaffModel\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportAbsensiStaffController extends BaseController
{
    public function index(){
        return view("present-staff.report.index", [
            'report' => StaffAttendance::where('academic_year_id', AcademicYear::where('active', true)->get()->first()->id)->get()
        ]);
    }

    public function reportHarian(Request $request){
        $date = $request->tanggal ? Carbon::parse($request->tanggal) : Carbon::today();
        $export = $request->export ?? false;


        if($request->staff_id == null){
            $attendanceData = Staff::with(['attendances' => function ($query) use ($date) {
                $query->where('clock_out', '!=', null);
                $query->whereDate('date', $date);
                $query->whereRaw('WEEKDAY(date) < 5');
            }])->get();
        }else {
            $staff = Staff::find($request->staff_id);
            $attendanceData = $staff->attendances()->whereDate('date', $date)->get();
        }

        if ($export)
            return view('present-staff.report.export', [
                'periode' => $date->translatedFormat('l, d F Y'),
                'absen' => $this->count($attendanceData),
            ]);

        return view('present-staff.report.harian', [
            'absen' => $this->count($attendanceData),
            'rentang' => $date->translatedFormat('l, d F Y'),
        ]);
    }

    private function count($attendanceData, $largeTimeFrame = false){
        $attendanceData->each(function ($staff) use ($largeTimeFrame){
            $totalDuration = $staff->attendances->sum(function ($attendance) {
                $clockIn = Carbon::parse($attendance->clock_in);
                $clockOut = Carbon::parse($attendance->clock_out);
                return $clockOut->diffInSeconds($clockIn); // Menghitung selisih dalam detik
            });

            $interval = Carbon::now()->subSeconds($totalDuration)->diff(Carbon::now());

            if ($largeTimeFrame == true){
                $duration = sprintf(
                    '%d Hari %d Jam %d Menit %d Detik',
                    $interval->days,
                    $interval->h,
                    $interval->i,
                    $interval->s
                );
            } else {
                $duration = sprintf(
                    '%d Jam %d Menit %d Detik',
                    $interval->h,
                    $interval->i,
                    $interval->s
                );
            }

            $staff->total_work_duration = $duration;
        });
        return $attendanceData;
    }

    public function reportMingguan(Request $request){
        $date = $request->tanggal ? Carbon::parse($request->tanggal) : Carbon::today();
        $export = $request->export ?? false;

        $startOfWeek = Carbon::parse($date)->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::parse($date)->endOfWeek(Carbon::FRIDAY);
        $formattedStartOfWeek = $startOfWeek->translatedFormat('l, d F Y');
        $formattedEndOfWeek = $endOfWeek->translatedFormat('l, d F Y');

        if($request->staff_id == null){
            $attendanceData = Staff::with(['attendances' => function ($query) use ($startOfWeek, $endOfWeek) {
                $query->where('clock_out', '!=', null);
                $query->whereRaw('WEEKDAY(date) < 5');
                $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
            }])->get();
        }else {
            $staff = Staff::find($request->staff_id);
            $attendanceData = $staff->attendances()->whereDate('date', $date)->get();
        }

        if ($export)
            return view('present-staff.report.export', [
                'periode' => "$formattedStartOfWeek S/D $formattedEndOfWeek",
                'absen' => $this->count($attendanceData, true),
            ]);


        return view('present-staff.report.mingguan', [
            'absen' => $this->count($attendanceData, true),
            'rentang' => "$formattedStartOfWeek S/D $formattedEndOfWeek",
        ]);
    }

    public function reportBulanan(Request $request){
        if ($request->date != null){
            $result = explode(" - ", $request->date);
            $startOfMonth = Carbon::parse($result[0]);
            $endOfMonth = Carbon::parse($result[1]);
            $attendanceData = Staff::with(['attendances' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->where('clock_out', '!=', null);
                $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
                $query->whereRaw('WEEKDAY(date) < 5');
            }])->get();
            $formattedRange = $startOfMonth->isoFormat('D MMMM YYYY') . ' sampai ' . $endOfMonth->isoFormat('D MMMM YYYY');
        }

        $export = $request->export ?? false;
        if ($export)
            return view('present-staff.report.export', [
                'periode' => $formattedRange,
                'absen' => $this->count($attendanceData ?? collect([]), true),
            ]);

        return view('present-staff.report.bulanan', [
                'absen' => $this->count($attendanceData ?? collect([]), true),
                'rentang' => $formattedRange ?? "",
                'startDate' =>  (isset($startOfMonth)) ? $startOfMonth->format('m/d/Y') : date('m/d/YYYY') ,
                'endDate' =>  (isset($endOfMonth)) ? $endOfMonth->format('m/d/Y') : date('m/d/YYYY')
            ]);
    }

    public function destroy($id){
        try {
            StaffAttendance::find($id)->delete();
            return redirect()->to(route("manage.report.absenStaff"))->with("sukses", "Data Berhasil Dihapus");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route("manage.report.absenStaff"))->with("gagal", "Data Gagal Dihapus");
        }
    }

    public function update($id){
        try {
            $data = StaffAttendance::find($id);
            $str = $data->notes . " & Absen Keluar By Dev";
            $update = [
                'notes' => $str,
                'clock_out' => '14:00:00'
            ];
            $data->update($update);
            return redirect()->to(route("manage.report.absenStaff"))->with("sukses", "Data Berhasil di Ubah");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route("manage.report.absenStaff"))->with("gagal", "Data Gagal di Ubah");
        }
    }

    public function updateClockOut(Request $request){
        try {
            $data = StaffAttendance::find($request->slot);
            $str = $data->notes . " & Absen Keluar By Dev Telah Di Edit";
            if (strtotime($request->currentValue) <= strtotime($data->clock_in)) {
                return $this->sendError("Gagal", 400);
            }
            $update = [
                'notes' => $str,
                'clock_out' => $request->currentValue
            ];
            $data->update($update);
            return $this->sendResponse([], "Sukses");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route("manage.report.absenStaff"))->with("gagal", "Data Gagal di Ubah");
        }
    }

    public function updateClockIn(Request $request){
        try {
            $data = StaffAttendance::find($request->slot);
            $str = $data->notes . " & Absen Masuk By Dev Telah Di Edit";
            if (strtotime($request->currentValue) >= strtotime($data->clock_out)) {
                return $this->sendError("Gagal", 400);
            }
            $update = [
                'notes' => $str,
                'clock_in' => $request->currentValue
            ];
            $data->update($update);
            return $this->sendResponse([], "Sukses");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route("manage.report.absenStaff"))->with("gagal", "Data Gagal di Ubah");
        }
    }
}
