<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\StaffModel\Staff;
use App\Models\StaffModel\StaffLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffLoginController extends BaseController
{
    public function index(Request $request){
        if ($request->export == true)
            return view('present-staff.authentication.export', [
                'staff' => Staff::whereHas('login')->orderBy('name', 'ASC')->get(),
            ]);

        return view('present-staff.authentication.index', [
            'staffs' => Staff::get(),
        ]);
    }

    public function store(Request $request){
        try {
            $staff = Staff::findOrFail($request->staff_id);
            StaffLogin::create([
                'staff_id' => $staff->id,
                'password' => "p4ssw0rd",
            ]);
            return redirect()->to(route('manage.auth.staff'))->with("sukses", "Akun Berhasil Dibuat, Password Default adalah p4ssw0rd");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.staff'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function update(Request $request){
        try {
            $staff = Staff::findOrFail($request->staff_id);
            StaffLogin::where('staff_id', $staff->id)->update([
                'device_token' => null
            ]);
            return redirect()->to(route('manage.auth.staff'))->with("sukses", "Akun Berhasil DI Unlock");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.staff'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function destroy(Request $request){
        try {
            $staff = Staff::findOrFail($request->staff_id);
            StaffLogin::where('staff_id', $staff->id)->delete();
            return redirect()->to(route('manage.auth.staff'))->with("sukses", "Akun Berhasil Di Remove");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.staff'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'XMAC' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Request Tidak Lengkap", 422);

        $staff = Staff::where('email', $request->email)->first();

        if (!$staff)
            return $this->sendError("Username / Password Salah!!", 401);

        $staffLogin = StaffLogin::where('staff_id', $staff->id)->first();

        if (!$staffLogin || !Hash::check($request->password, $staffLogin->password))
            return $this->sendError("Username / Password Salah!!", 401);

        if ($staffLogin->device_token != null)
            if($staffLogin->device_token != $request->XMAC)
                return $this->sendError("Akun Terkunci Hubungi Administrator", 401);

        Carbon::setLocale('id');
        $currentDateTime = Carbon::now();
        $exp = $currentDateTime->addDays(14);
        $token = $staffLogin->createToken('teacher-token', ['*'], $exp)->plainTextToken;
        StaffLogin::where('staff_id', $staff->id)->update([
            'device_token' => $request->XMAC ?? null
        ]);
        return $this->sendResponse([
            'token' => $token,
            'data' => $staff,
        ], 200, "Login Berhasil");


    }
}
