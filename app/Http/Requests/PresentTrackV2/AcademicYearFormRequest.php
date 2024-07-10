<?php

namespace App\Http\Requests\PresentTrackV2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcademicYearFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser")
            return true;
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama TA Tidak Boleh Kosong',
            'start_year.required' => 'Tahun Awal Tidak Boleh Kosong',
            'end_year.required' => 'Tahun Akhir Tidak Boleh Kosong',
        ];
    }
}
