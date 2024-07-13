<?php

namespace App\Http\Controllers\PresentStaff;

use App\Http\Controllers\Controller;
use App\Models\StaffModel\Staff;
use App\Models\StaffModel\StaffLogin;
use Illuminate\Http\Request;

class StaffLoginController extends Controller
{
    public function index(){
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
}
