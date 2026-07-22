<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class RelativePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permission' => 'required|integer|in:1,2',
        ];
    }

    public function messages(): array
    {
        return [
            'permission.required' => '权限不能为空',
            'permission.in'       => '权限仅支持1仅查看/2可管理',
        ];
    }
}
