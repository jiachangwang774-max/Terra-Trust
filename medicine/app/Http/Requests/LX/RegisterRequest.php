<?php

namespace App\Http\Requests\LX;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username'  => 'required|string|min:5|max:20|unique:users,username',
            'password'  => 'required|string|min:6|max:20',
            'phone'     => 'required|string|max:20|unique:users,phone',
            'real_name' => 'nullable|string|max:50',
            'gender'    => 'nullable|integer|in:0,1,2',
            'age'       => 'nullable|integer|min:1|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required'  => '用户名不能为空',
            'username.min'       => '用户名至少5位',
            'username.unique'    => '用户名已存在',
            'password.required'  => '密码不能为空',
            'password.min'       => '密码至少6位',
            'phone.required'     => '手机号不能为空',
            'phone.unique'       => '手机号已被注册',
            'gender.in'          => '性别仅支持0未知/1男/2女',
        ];
    }
}
