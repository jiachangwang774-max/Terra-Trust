<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class RelativeBindRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'      => 'required|string|max:20',
            'relation'   => 'required|string|max:20',
            'permission' => 'required|integer|in:1,2',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required'       => '亲属手机号不能为空',
            'relation.required'    => '亲属关系不能为空',
            'permission.required'  => '权限不能为空',
            'permission.in'        => '权限仅支持1仅查看/2可管理',
        ];
    }
}
