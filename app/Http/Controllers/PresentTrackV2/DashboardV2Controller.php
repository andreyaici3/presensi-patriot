<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardV2Controller extends Controller
{
    public function index(){
        return view('present-track-v2.dashboard');
    }
}
