<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AndroidController extends Controller
{
    public function index()
    {
        return view('android.index');
    }
}
