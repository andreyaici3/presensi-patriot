<?php

use App\Http\Controllers\ApiControllers\ReportPerformaController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ApiControllers\ApiRequestTest;
use App\Http\Controllers\ApiControllers\ScrapController;
use App\Http\Controllers\ApiControllers\v1\staff\ApiStaffController;
use App\Http\Controllers\TestApiController;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(TestApiController::class)->group(function(){
    Route::post('/assign-jadwal', 'assignJadwal');
    Route::get('/jadwal', 'getJadwal');
    Route::post('/assign-present/{id}', 'absen');
    Route::get('/absen-sukses', 'absenSukses');
    Route::get('/absen-gagal', 'absenGagal');
    Route::get('/absen-sudah', 'absenSudah');
    Route::get('/getJadwal/{id}', 'getJadwalByGuru');
    Route::get('/getJadwalV1/{id}', 'getJadwalByGuruV1');
    Route::get('/checkAbsen/{kode_guru}', 'checkAbsen');
});



Route::controller(AuthenticationController::class)->group(function(){
    Route::post('/authentication', 'apiLogin');
    Route::post('/authentication-test', 'testApiLoginSukses');
    
});

Route::controller(ApiRequestTest::class)->group(function(){
    Route::post('/post', 'post');
});

Route::controller(ReportPerformaController::class)->group(function(){
    Route::post('/performa', 'mainFunction');
});

Route::controller(ScrapController::class)->group(function(){
    Route::get('/scrapWeb', 'index');
});


//V1
//staff
Route::group(['prefix'=>'v1'],function(){
    Route::post('/staff/login', [ApiStaffController::class, "login"]);
    
    Route::middleware(['auth:sanctum', 'abilities:absen'])->group(function(){
       Route::controller(ApiStaffController::class)->group(function(){
        Route::post("/staff/absen/{type}", "absen");
       });
    });

});
