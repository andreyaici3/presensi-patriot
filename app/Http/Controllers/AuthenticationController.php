<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends BaseController
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard',
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->to(route("dashboard"));
        } else {
            return redirect()->to(route('login'))->with("gagal", "Silahkan Periksa Kembali Email / Password");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to(route('login'))->with('sukses', "Logout Berhasil!!!");
    }

}
