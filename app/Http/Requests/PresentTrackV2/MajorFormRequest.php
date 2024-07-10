<?php

namespace App\Http\Requests\PresentTrackV2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MajorFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser")
            return true;

        return false;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'code' => 'required|unique:majors,code,' . $id,
            'name' => 'required'
        ];
    }

    public function messages() :array {
        return [
            'code.required' => "Kode Jurusan Tidak Boleh Kosong",
            'code.unique' => "Kode Sudah Terdaftar Di Sistem",
            'name.required' => "Nama Jurusan Tidak Boleh Kosong",
        ];
    }
}
