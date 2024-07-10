<?php

namespace App\Http\Requests\PresentTrackV2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClassesFormRequest extends FormRequest
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
            'rombel_number' => 'required|max:1',
        ];
    }

    public function messages(): array {
        return [
            'rombel_number.required' => 'Nomor Rombel Tidak Boleh Kosong',
            'rombel_number.max' => 'Nomor Romber Hanya Boleh 1 Karakter'
        ];
    }
}
