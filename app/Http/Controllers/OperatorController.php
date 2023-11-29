<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index', [
            'operator' => User::get(),
        ]);
    }

    public function create()
    {
        return view('operator.create');
    }

    public function store(Request $request){
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return redirect()->to(route('operator.index'))->with('success', "Operator Berhasil Ditambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('operator.index'))->with('gagal', "Operator Gagal Ditambahkan");
        }

    }
}
