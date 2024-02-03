<?php

namespace App\Http\Requests\AbsenStaff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "wakasek" || Auth::user()->role == "superuser")
            return true;
        return false;
    }

    public function rules(): array
    {

        switch ($this->method()) {
            case "PUT":
                return [
                    "nama" => ["required"],
                    "kdStaff" => ["required"],
                    "email" => ["required"],
                    "nik" => ["required"],
                ];
                break;
            default:
                return [
                    "nama" => ["required"],
                    "kdStaff" => ["required"],
                    "email" => ["required", "email", "unique:master_guru"],
                    "nik" => ["required"],
                ];
                break;
        }
    }

    public function messages(): array
    {
        return [
            "nama.required" => "Nama Staff Tidak Boleh Kosong",
            "kdStaff.required" => "Kode Staff Tidak Boleh Kosong",
            "nik.required" => "NIPP / NUPTK Tidak Boleh Kosong",
            "email.required" => "Email Tidak Boleh Kosong",
            "email.unique" => "Email Sudah Terdaftar",
        ];
    }
}
