<?php

namespace App\Http\Controllers\PresentTrackV2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Teacher;
use App\Models\TeacherLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherLoginController extends BaseController
{
    public function index(){
        return view('present-track-v2.authentication.guru.index', [
            'guru' => Teacher::orderBy('kode_guru', 'ASC')->get(),
        ]);
    }

    public function store(Request $request){
        try {

            $guru = Teacher::findOrFail($request->teacher_id);
            TeacherLogin::create([
                'teacher_id' => $guru->id,
                'password' => "p4ssw0rd",
            ]);
            return redirect()->to(route('manage.auth.guru'))->with("sukses", "Akun Berhasil Dibuat, Password Default adalah p4ssw0rd");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.guru'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function update(Request $request){
        try {
            $guru = Teacher::findOrFail($request->teacher_id);
            TeacherLogin::where('teacher_id', $guru->id)->update([
                'device_token' => null
            ]);
            return redirect()->to(route('manage.auth.guru'))->with("sukses", "Akun Berhasil DI Unlock");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.guru'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function destroy(Request $request){
        try {
            $guru = Teacher::findOrFail($request->teacher_id);
            TeacherLogin::where('teacher_id', $guru->id)->delete();
            return redirect()->to(route('manage.auth.guru'))->with("sukses", "Akun Berhasil Di Remove");
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->to(route('manage.auth.guru'))->with("gagal", "Akun Gagal Dibuat");
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'XMAC' => 'required',
        ]);

        if ($validator->fails())
            return $this->sendError("Username dan Password Tidak Boleh Kosong", 422);

        // Get the teacher by email
        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher)
            return $this->sendError("Username / Password Salah!!", 401);

        // Get the teacher login record
        $teacherLogin = TeacherLogin::where('teacher_id', $teacher->id)->first();

        if (!$teacherLogin || !Hash::check($request->password, $teacherLogin->password))
            return $this->sendError("Username / Password Salah!!", 401);

        if ($teacherLogin->device_token != null)
            return $this->sendError("Akun Terkunci Hubungi Administrator", 401);

        Carbon::setLocale('id');
        $currentDateTime = Carbon::now();
        $exp = $currentDateTime->addDays(14);
        $token = $teacherLogin->createToken('teacher-token', ['*'], $exp)->plainTextToken;
        TeacherLogin::where('teacher_id', $teacher->id)->update([
            'device_token' => $request->XMAC ?? null
        ]);
        return $this->sendResponse([
            'token' => $token,
            'data' => $teacher,
        ], 200, "Login Berhasil");

    }


}
