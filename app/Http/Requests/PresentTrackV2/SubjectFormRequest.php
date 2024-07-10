<?php

namespace App\Http\Requests\PresentTrackV2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubjectFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (Auth::user()->role == "superuser" || Auth::user()->role == "admin")
            return true;
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }


    public function messages():array {
        return [
            'name.required' => 'Mata Pelajaran Tidak Boleh Kosong'
        ];
    }
}
