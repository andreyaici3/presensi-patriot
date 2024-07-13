<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AndroidController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterJadwalController;
use App\Http\Controllers\PresentTrackV2\AcademicYearController;
use App\Http\Controllers\PresentTrackV2\AttendancesController;
use App\Http\Controllers\PresentTrackV2\ClassController;
use App\Http\Controllers\PresentTrackV2\DashboardV2Controller;
use App\Http\Controllers\PresentTrackV2\DaysController;
use App\Http\Controllers\PresentTrackV2\GuruV2Controller;
use App\Http\Controllers\PresentTrackV2\HomeController;
use App\Http\Controllers\PresentTrackV2\MajorsController;
use App\Http\Controllers\PresentTrackV2\PermissionController;
use App\Http\Controllers\PresentTrackV2\ReportAbsensiTeacherController;
use App\Http\Controllers\PresentTrackV2\SchedulesController;
use App\Http\Controllers\PresentTrackV2\SubjectsControler;
use App\Http\Controllers\PresentTrackV2\TeacherLoginController;
use App\Http\Controllers\PresentTrackV2\TelegramUserController;
use App\Http\Controllers\Superuser\OperatorController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\SiswaController\AuthSiswaController;
use App\Http\Controllers\Superuser\DatabasesController;
use App\Http\Controllers\PresentTrackV2\TimesSlotsController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Wakasek\LogStaffController;
use App\Http\Controllers\Wakasek\StaffController;
use App\Models\TeacherLogin;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::controller(DashboardV2Controller::class)->group(function(){
        Route::get("/dashboard", 'index')->name('dashboard');
    });



    // Disini Terbaru semua yang sudah di test
    Route::middleware(["user-role:superuser|kurikulum|admin "])->group(function(){
        Route::controller(SubjectsControler::class)->group(function(){
            Route::get("/manage/subject", "index")->name("manage.subject");
            Route::get("/manage/subject/create", "create")->name("manage.subject.create");
            Route::post("/manage/subject", "store");
            Route::get("/manage/subject/{id}", "edit")->name("manage.subject.edit");
            Route::put("/manage/subject/{id}", "update");
            Route::DELETE("/manage/subject/{id}/delete", "destroy")->name('manage.subject.delete');
        });

        Route::controller(ReportAbsensiTeacherController::class)->group(function(){
            Route::get('/manage/reportAbsenGuru', 'index')->name("manage.report.absenGuru");
            Route::get("/manage/reportHarian", 'reportHarian')->name("manage.report.harian");
            Route::get("/manage/reportMinggan", 'reportMinggan')->name("manage.report.mingguan");
            Route::get("/manage/reportBulanan", 'reportBulanan')->name("manage.report.bulanan");
        });

        Route::controller(SchedulesController::class)->group(function(){
            Route::get("/manage/schedules", 'index')->name("manage.schedules");
            Route::get("/manage/schedules/create", 'create')->name("manage.schedules.create");
            Route::put("/manage/schedules/saveChanges", 'saveChanges')->name('manage.schedules.saveChanges');
        });
    });

    Route::middleware(["user-role:superuser|kurikulum"])->group(function(){
        Route::controller(PermissionController::class)->group(function(){
            Route::get("/manage/permission", 'index')->name("manage.permission");
            Route::put("/manage/permission/{id}/accept", 'accept')->name("manage.permission.accept");
            Route::delete("/manage/permission/{id}/destroy", 'destroy')->name("manage.permission.reject");
        });

        Route::controller(AttendancesController::class)->group(function(){
            Route::get("/attendance/todayIsFree", 'fullPresent')->name("attendance.free");
        });

        Route::controller(AcademicYearController::class)->group(function(){
            Route::get("/manage/academic-year", "index")->name("manage.academic.year");
            Route::get("/manage/academic-year/creates", "create")->name("manage.academic.year.create");
            Route::get("/manage/academic-year/{id}", "edit")->name("manage.academic.year.edit");
            Route::put("/manage/academic-year/{id}", "update");
            Route::post("/manage/academic-year", "store");
            Route::post("/manage/academic-year/{id}/switch", "switchActive")->name("manage.academic.year.switch");
            Route::delete("/manage/academic-year/{id}/delete", "destroy")->name("manage.academic.year.delete");
        });
    });



    // Sampai Disini Terbarunya
    Route::controller(GuruV2Controller::class)->group(function(){
        Route::get("/manage/guru", "index")->name("manage.guru");
        Route::get("/manage/guru/create", "create")->name("manage.guru.create");
        Route::post("/manage/guru", "store");
        Route::get("/manage/guru/{id}", "edit")->name("manage.guru.edit");
        Route::put("/manage/guru/{id}", "update");
        Route::DELETE("/manage/guru/{id}/delete", "destroy")->name('manage.guru.delete');
    });

    Route::controller(ClassController::class)->group(function(){
        Route::get("/manage/class", "index")->name("manage.class");
        Route::get("/manage/class/create", "create")->name("manage.class.create");
        Route::post("/manage/class", "store");
        Route::get("/manage/class/{id}", "edit")->name("manage.class.edit");
        Route::get("/manage/class/{id}/generate", "generate")->name("manage.class.generate");
        Route::put("/manage/class/{id}", "update");
        Route::DELETE("/manage/class/{id}/delete", "destroy")->name('manage.class.delete');
    });

    Route::controller(MajorsController::class)->group(function(){
        Route::get("/manage/major", "index")->name("manage.major");
        Route::get("/manage/major/create", "create")->name("manage.major.create");
        Route::post("/manage/major", "store");
        Route::get("/manage/major/{id}", "edit")->name("manage.major.edit");
        Route::put("/manage/major/{id}", "update");
        Route::DELETE("/manage/major/{id}/delete", "destroy")->name('manage.major.delete');
    });

    Route::controller(DaysController::class)->group(function(){
        Route::get("/manage/days", "index")->name("manage.days");
        Route::get("/manage/days/{id}/detail", "detail")->name("manage.days.detail");
    });

    Route::controller(TimesSlotsController::class)->group(function(){
        Route::get("/manage/{id_hari}/create", 'create')->name("manage.time.create");
        Route::get("/manage/{id_hari}/edit", 'edit')->name("manage.time.edit");
        Route::post("/manage/{id_hari}/create", 'store');
        Route::put("/manage/{id_hari}/edit", 'update');
        Route::delete("/manage/{id_hari}/delete/{id_time}", 'destroy')->name("manage.time.delete");
    });

    Route::controller(TelegramUserController::class)->group(function(){
        Route::get("/manage/telegram-user", 'index')->name("manage.tg");
        Route::get("/manage/telegram-user/creates", 'create')->name("manage.tg.create");
        Route::post("/manage/telegram-user/creates", 'store');
        Route::get("/manage/telegram-user/edit/{id}", 'edit')->name("manage.tg.edit");
        Route::put("/manage/telegram-user/update/{id}", 'update')->name("manage.tg.update");
        Route::delete("/manage/telegram-user/{id}/delete", 'destroy')->name("manage.tg.delete");
    });

    Route::controller(TeacherLoginController::class)->group(function(){
        Route::get("/manage/auth-guru", 'index')->name("manage.auth.guru");
        Route::post("/manage/auth-guru", 'store');
        Route::put("/manage/auth-guru", 'update');
        Route::delete("/manage/auth-guru", 'destroy');
    });

    // Yang Baru Ada Disini
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/monitor', 'monitor')->name('dashboard.monitor');
        // Route::get('/', 'index')->name('dashboard');
    });

    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

});

Route::middleware('guest')->group(function(){
    Route::controller(AuthenticationController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('auth.authenticate');
    });

    Route::controller(AuthSiswaController::class)->group(function(){
        Route::get('/registration', 'register')->name('siswa.register');
        Route::post('/registration', 'store')->name('siswa.register.store');
    });

});

Route::controller(HomeController::class)->group(function(){
    Route::get("/", "index")->name("home");
});




// Route::view('/', 'dashboard')->name('dashboard');





// Route::get('/sample/{id}', [JadwalController::class, 'getJadwalByGuru']);

//Route
Route::get('/test', [AttendancesController::class, 'attendanceOnTelegram']);


//Mulai Mengalihkan Routing ke Middleware
Route::middleware(["auth", "user-role:superuser"])->group(function(){
    Route::controller(DatabasesController::class)->group(function(){
        Route::get("/database", "index")->name("superuser.database");
    });

    Route::controller(OperatorController::class)->group(function(){
        Route::get('/operator','index')->name('superuser.operator.index');
        Route::get('/operator/create', 'create')->name('superuser.operator.create');
        Route::post('/operator', 'store')->name('superuser.operator.store');
        Route::get('/operator/{id}/edit', 'edit')->name('superuser.operator.edit');
        Route::PUT('/operator/{id}', 'update')->name('superuser.operator.update');
        Route::delete('/operator/{id}', 'destroy')->name('superuser.operator.delete');
    });
});

Route::middleware(["auth", "user-role:superuser|wakasek"])->group(function(){
    Route::controller(StaffController::class)->group(function(){
        Route::get("/staff", "index")->name("wakasek.staff");
        Route::get("/staff/create", "create")->name("wakasek.staff.create");
        Route::post("/staff", "store");
        Route::get("/staff/{id_staff}/edit", "edit")->name("wakasek.staff.edit");
        Route::put("/staff/{id_staff}", "update")->name("wakasek.staff.update");
        Route::delete("/staff/{id_staff}", "destroy");

        Route::get("/staff/akun", "akun")->name("wakasek.staff.akun");
        Route::delete("/staff/{id_akun}/delete", "destroyAkun")->name("wakasek.staff.akun.delete");
        Route::post("/staff/akun/create", "createAkun")->name("wakasek.staff.akun.create");
    });

    Route::controller(LogStaffController::class)->group(function(){
        Route::get("/staff/log", "index")->name("wakasek.staff.log");
    });
});


