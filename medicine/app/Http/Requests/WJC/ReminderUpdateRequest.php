<?php

namespace App\Http\Requests\WJC;

use Illuminate\Foundation\Http\FormRequest;

class ReminderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => 'nullable|integer|min:1',
            'medicine_id'     => 'required|integer|min:1',
            'remind_time'     => 'required|date_format:H:i:s',
            'dosage'          => 'required|string|max:50',
            'repeat_type'     => 'required|integer|in:1,2,3',
            'repeat_days'     => 'nullable|string|max:20',
            'remind_method'   => 'required|integer|in:1,2,3',
        ];
    }

    public function messages(): array
    {
        return [
            'medicine_id.required'   => '药物ID不能为空',
            'remind_time.required'   => '提醒时间不能为空',
            'dosage.required'        => '剂量不能为空',
            'repeat_type.required'   => '重复类型不能为空',
            'remind_method.required' => '提醒方式不能为空',
        ];
    }
}
