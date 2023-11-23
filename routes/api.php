<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TestApiController;
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
    Route::post('/assign-present', 'absen');
});

Route::controller(AuthenticationController::class)->group(function(){
    Route::post('/authentication', 'apiLogin');
});