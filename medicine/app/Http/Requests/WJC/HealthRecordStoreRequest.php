<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class HealthRecordStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blood_pressure_high' => 'nullable|string|max:10',
            'blood_pressure_low'  => 'nullable|string|max:10',
            'blood_sugar'         => 'nullable|string|max:10',
            'weight'              => 'nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
