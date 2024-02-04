<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superuser\OperatorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function index()
    {
        return view('superuser.operator.index', ['operator' => User::whereNot('role', 'superuser')->get()]);
    }

    public function create()
    {
        return view('superuser.operator.create');
    }

    public function store(OperatorRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return $this->result(true, "Di Tambahkan");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Tambahkan");
        }
    }

    public function edit($id)
    {
        return view('superuser.operator.edit', ["user" => User::find($id),]);
    }

    public function update(OperatorRequest $request, $id)
    {
        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            return $this->result(true, "Di Update");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "Di Update");
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return $this->result(true, "Di hapus");
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->result(false, "dihapus");
        }
    }

    private function result($bool = true, $messages = ""){
        if ($bool){
            return redirect()->to(route('superuser.operator.index'))->with('sukses', "Operator Berhasil $messages");
        } else {
            return redirect()->to(route('superuser.operator.index'))->with('gagal', "Operator Gagal Di $messages");
        }
    }
}
