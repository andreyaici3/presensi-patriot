<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabasesController extends Controller
{
    public function index()
    {
        return view("database.index", [
            "tables" => DB::select('SHOW TABLES')
        ]);
    }
}
