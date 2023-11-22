<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AndroidController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterJadwalController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\LoginRegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware('auth')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', DashboardController::class)->name('dashboard');
    });
    
    Route::controller(GuruController::class)->group(function () {
        Route::get('/guru', 'index');
        Route::get('/guru/create', 'create');
        Route::post('/guru', 'store');
        Route::get('/guru/{id}/edit', 'edit');
        Route::put('/guru/{id}', 'update');
        Route::delete('/guru/{id}', 'destroy');
    });
    
    Route::controller(KelasController::class)->group(function () {
        Route::get('/kelas', 'index');
        Route::get('/kelas/create', 'create');
        Route::post('/kelas', 'store');
        Route::get('/kelas/{id}/edit', 'edit');
        Route::put('/kelas/{id}', 'update');
        Route::delete('/kelas/{id}', 'destroy');
    });
    
    Route::controller(WaktuController::class)->group(function () {
        Route::get('/waktu', 'index');
        Route::get('/waktu/create', 'create');
        Route::post('/waktu', 'store');
        Route::get('/waktu/{id}/edit', 'edit');
        Route::put('/waktu/{id}', 'update');
        Route::delete('/waktu/{id}', 'destroy');
    });
    
    Route::controller(JurusanController::class)->group(function () {
        Route::get('/jurusan', 'index');
        Route::get('/jurusan/create', 'create');
        Route::post('/jurusan', 'store');
        Route::get('/jurusan/{id}/edit', 'edit');
        Route::put('/jurusan/{id}', 'update');
        Route::delete('/jurusan/{id}', 'destroy');
    });
    
    Route::controller(JadwalController::class)->group(function () {
        Route::get('/jadwal', 'index');
        Route::get('/jadwal/{kode_guru}/filter', 'filter');
        Route::get('/jadwal/create', 'create');
        Route::post('/jadwal', 'store');
        Route::post("/jadwal/store-jadwal", "storeJadwal");
        Route::post("/process-store", "processStore");
        Route::delete("/jadwal/delete/{id}", "destroy");
    });
    
    Route::controller(HariController::class)->group(function () {
        Route::get('/master-jadwal', 'index');
        // Route::get('/hari', 'index');
        Route::get('/hari/create', 'create');
        Route::post('hari', 'store');
        Route::get('/hari/{id}/edit', 'edit');
        Route::put('/hari/{id}', 'update');
        Route::delete('/hari/{id}', 'destroy');
    });
    
    Route::controller(MasterJadwalController::class)->group(function () {
        Route::get('/hari/{id}/kelola', 'kelola_jam');
        Route::get('/master-jadwal/{id}/create', 'create');
        Route::post('/master-jadwal/{id}', 'store');
        Route::delete("/jadwal/delete/{id}", "destroy");
    });

    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    
});

Route::middleware('guest')->group(function(){
    Route::controller(AuthenticationController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('auth.authenticate');    
       
    });
    
});



// Route::view('/', 'dashboard')->name('dashboard');




Route::controller(AbsenController::class)->group(function () {
    Route::get('/absen', 'index');
});






//Route Android
Route::get('/android', [AndroidController::class, 'index']);

//Route Operator
Route::get('/operator', [OperatorController::class, 'index']);

//Route Jurusan


//Route 
Route::get('/test', [WaktuController::class, "test"]);
