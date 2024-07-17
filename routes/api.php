<?php

use App\Http\Controllers\ApiControllers\ScrapController;
use App\Http\Controllers\ApiControllers\v1\staff\ApiStaffController;
use App\Http\Controllers\PresentStaff\StaffAttendancesController;
use App\Http\Controllers\PresentStaff\StaffLoginController;
use App\Http\Controllers\PresentTrackV2\AttendancesController;
use App\Http\Controllers\PresentTrackV2\PermissionController;
use App\Http\Controllers\PresentTrackV2\ReportAbsensiTeacherController;
use App\Http\Controllers\PresentTrackV2\SchedulesController;
use App\Http\Controllers\PresentTrackV2\TeacherLoginController;
use App\Http\Controllers\PresentTrackV2\WebhookController;
use App\Models\StaffModel\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ScrapController::class)->group(function(){
    Route::get('/scrapWeb', 'index');
});



Route::prefix('v2')->group(function () {
    Route::get("/attendanceOutBySystem", [StaffAttendancesController::class, "attendanceOutBySystem"]);
    //Teacher Track
    Route::controller(TeacherLoginController::class)->group(function(){
        Route::post("/login", "login");
    });

    Route::controller(WebhookController::class)->group(function(){
        Route::post("/webhook/telegram", 'handleWebhook');
    });

    Route::middleware('sanctum.auth')->group(function(){
        Route::controller(AttendancesController::class)->group(function(){
            Route::get("/checkAbsen", "checkAbsen");
            Route::post("/attendance", 'attendaceOnDevice');
        });

        Route::controller(SchedulesController::class)->group(function(){
            Route::post("/getAllJadwal", 'getAllJadwal');
            Route::get("/getKelasByJadwal", "getKelasByJadwal");
        });

        Route::controller(ReportAbsensiTeacherController::class)->group(function(){
            Route::get("/performa", "performa");
        });

        Route::controller(PermissionController::class)->group(function(){
            Route::post("/attendance/manual", 'create');
        });

        Route::controller(StaffAttendancesController::class)->group(function(){
            Route::post("/staff/attendance/assign", "filter")->name("api.auth.staff");
            Route::post("/staff/attendance/check", 'check')->name("api.auth.staff");
        });
    });

    //staff track
    Route::controller(StaffLoginController::class)->group(function(){
        Route::post('/login/staff', 'login');
    });


});

