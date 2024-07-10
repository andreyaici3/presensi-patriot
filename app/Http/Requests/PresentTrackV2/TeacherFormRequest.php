<?php

namespace App\Http\Requests\PresentTrackV2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser" || Auth::user()->role == "staff" || Auth::user()->role == "admin")
            return true;

        return false;
    }

    public function rules(): array
    {
        $teacherId = $this->route('id');
        return [
            'first_name' => 'required|min:3',
            'nip' => 'required|unique:teachers,nip,' . $teacherId,
            'kode_guru' => 'required|unique:teachers,kode_guru,' . $teacherId,
            'email' => 'required|unique:teachers,email,' . $teacherId
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Nama depan Tidak Boleh Kosong',
            'nip.required' => 'NIP Tidak Boleh Kosong',
            'nip.unique' => 'NIP Sudah Digunakan',
            'kode_guru.required' => 'kode_guru Tidak Boleh Kosong',
            'kode_guru.unique' => 'Kode guru Sudah Dipakai',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Terdaftar',
        ];
    }
}
