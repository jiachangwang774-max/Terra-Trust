<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class ReminderBatchStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ids'      => 'required|array|min:1',
            'ids.*'    => 'integer|min:1',
            'is_active' => 'required|integer|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required'       => '提醒ID列表不能为空',
            'ids.array'          => '提醒ID列表必须为数组',
            'is_active.required' => '开关状态不能为空',
            'is_active.in'       => '开关状态仅支持0关闭/1开启',
        ];
    }
}
