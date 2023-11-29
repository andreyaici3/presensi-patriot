<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Operator;

class OperatorController extends Controller
{
    public function index()
    {
        return view('operator.index', [
            'operator' => User::whereNot('role', 'superuser')->get(),
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

    public function edit($id)
    {
        $user = User::find($id);

        return view('operator.edit', [
            "user" => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return redirect()->to(route('operator.index'))->with('success', "Operator Berhasil Di Update");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('operator.index'))->with('gagal', "Operator Gagal Di Update");
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return redirect()->to(route('operator.index'))->with('success', "Operator Berhasil DiHapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(route('operator.index'))->with('gagal', "Operator Gagal DiHapus");
        }
    }
}
