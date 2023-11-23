<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\AkunGuru;
use App\Models\Guru;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends BaseController
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function login()
    {
        return view('auth.login');
        // return view('api.contoh');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::HOME)
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    

    public function apiLogin(Request $request)
    {

        $email = AkunGuru::whereEmail($request->email)->first();
        if ($email != null){
            if(Hash::check($request->password, $email->password)){
                $result = DB::table('personal_access_tokens')->where('tokenable_id', $email->id);
                if ($result->count() > 0){
                    //blokir user
                    return $this->sendError('Anda Terdeteksi Login Pada Perangkat Baru', ['error'=>'failed']);
                } else {
                    // create token baru
                    $success['token'] =  $email->createToken('AppLogin')->plainTextToken;
                    return $this->sendResponse($success, 'User login successfully.');
                }
                
            }else{
                return $this->sendError('Silahkan Cek Email / Password Anda.', ['error'=>'failed']);
            }
        }else{
            return $this->sendError('Silahkan Cek Email / Password Anda.', ['error'=>'failed']);
        }
        
    }
}
