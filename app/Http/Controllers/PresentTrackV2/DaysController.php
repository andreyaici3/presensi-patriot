<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\TimesSlot;


class DaysController extends Controller
{
    public function index(){
        return view("present-track-v2.akademik.day.index", [
            'days' => Day::get(),
        ]);
    }

    public function detail($id){
        $hari = Day::findOrFail($id);
        return view("present-track-v2.akademik.day.detail", [
            'times' => TimesSlot::where('day_id', $hari->id)->orderBy('jam_ke', 'ASC')->get(),
            'day'=> $hari,
        ]);
    }
}
