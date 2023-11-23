<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\AkunGuru;
use App\Models\Guru;
use App\Models\SessionAndroid;
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
                $result = SessionAndroid::where('email', $email->email);
                if ($result->count() > 0){
                    //ada session
                    if ($result->first()->mac_address == $request->XMAC){
                        $success['token'] =  $email->createTokens('AppLogin');
                        $success["user"] = Guru::where('email', $email->email)->first();
                        return $this->sendResponse($success, 'User login successfully.');
                    }else {
                        return $this->sendError('Anda Terdeteksi Login Pada Perangkat Baru', ['error'=>'failed']);
                    }
                }else {
                    $insert = SessionAndroid::create([
                        "email" => $request->email, 
                        "user_agent" => $request->XUA, 
                        "mac_address" => $request->XMAC,
                        "device_name" => $request->XNAME
                    ]);
                    if ($insert){
                        $success['token'] =  $email->createTokens('AppLogin');
                        $success["user"] = Guru::where('email', $email->email)->first();
                        return $this->sendResponse($success, 'User login successfully.');
                    }
                   
                }
                
            }else{
                return $this->sendError('Silahkan Cek Email / Password Anda.', ['error'=>'failed']);
            }
        }else{
            return $this->sendError('Silahkan Cek Email / Password Anda.', ['error'=>'failed']);
        }
        
    }

    public function testApiLoginSukses(){
        $jayParsedAry = [
            "success" => true, 
            "data" => [
                  "token" => "1|Kk1QodJOXDumelKibomV6SEHbFoGr2zkQoVYOvbA45fba2d1", 
                  "user" => [
                     "id" => 1, 
                     "kode_guru" => 63, 
                     "nik" => 3208102403010006, 
                     "nama_guru" => "Andrey Andriansyah, S.Kom", 
                     "email" => "andreyandri90@gmail.com", 
                     "created_at" => "2023-11-21T11:42:30.000000Z", 
                     "updated_at" => "2023-11-21T11:42:30.000000Z" 
                  ] 
               ], 
            "message" => "User login successfully." 
         ]; 

         return $jayParsedAry;
    }
}
