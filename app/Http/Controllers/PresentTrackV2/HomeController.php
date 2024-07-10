<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $now = Carbon::now(); // Waktu sekarang
        $majors = Major::with(['classes' => function ($query) use ($now) {
            $query->with(['scheduless' => function ($query) use ($now) {
                $query->with('timeSlot') // Memuat relasi timeslot
                      ->whereHas('timeSlot', function ($query) use ($now) {
                          $query->where('start_time', '<=', $now->format('H:i:s'))
                                ->where('end_time', '>=', $now->format('H:i:s'));
                      });
            }]);
        }])->get();

        return view("present-track-v2.landing.homepage", [
            'majors' => $majors,
            'currentDate' => Carbon::now(),
            'hariSekarang' => Carbon::now()->locale('id')->isoFormat('dddd'),
        ]);
    }
}
