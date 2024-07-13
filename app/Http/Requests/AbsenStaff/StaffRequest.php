<?php

namespace App\Http\Requests\AbsenStaff;

use App\Rules\UniqueWithConnection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "superuser")
            return true;
        return false;
    }


    public function rules(): array
    {
        $staffId = $this->route('id');
        $connection = env('DB_STAFF_CONNECTION');
        return [
            'name' => 'required|min:3',
            'position' => 'required',
            'email' => ['required', new UniqueWithConnection('staff', 'email', $staffId, $connection)],
            'nip' => ['required', new UniqueWithConnection('staff', 'nip', $staffId, $connection)],
            'phone' => ['required', new UniqueWithConnection('staff', 'phone', $staffId, $connection)],
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Nama Staff Tidak Boleh Kosong",
            'position.required' => "Jabatan Tidak Boleh Kosong",
            "phone.required" => "No Hp Tidak Boleh Kosong",
            "nip.required" => "NIPP / NUPTK Tidak Boleh Kosong",
            "email.required" => "Email Tidak Boleh Kosong",
            "email.unique_with_connection" => "Hmmz, Email Sudah Terdaftar",
            'nip.unique' => "NIPP / NUPTK Sudah Terdaftar",
            'phone.unique' => "No Hp. Sudah Terdaftar",
        ];
    }

}
