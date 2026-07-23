<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class ReminderTakeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'integer', 'in:1,2,3'],
            'note'   => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => '服药状态不能为空',
            'status.in'       => '状态仅支持1已服/2漏服/3跳过',
        ];
    }
}
