<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\StaffModel\StaffAttendance;
use Illuminate\Http\Request;

class ReportAbsensiStaffController extends Controller
{
    public function index(){
        return view("present-staff.report.index", [
            'report' => StaffAttendance::where('academic_year_id', AcademicYear::where('active', true)->get()->first()->id)->get()
        ]);
    }
}
