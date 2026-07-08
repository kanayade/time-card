<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reason' => 'required|string|max:255',

            'break_start.*' => 'nullable|date_format:H:i',
            'break_end.*' => 'nullable|date_format:H:i',
        ];
    }
    public function messages()
    {
        return [
            'start_time.required' => '出勤時間を入力してください',
            'start_time.date_format' => '出勤時間の形式が違います',
            'end_time.required' => '退勤時間を入力してください',
            'end_time.date_format' => '退勤時間の形式が違います',
            'reason.required' => '備考を記入してください',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_time >= $this->end_time) {
                $validator->errors()->add(
                    'start_time',
                    '出勤時間もしくは退勤時間が不適切な値です'
                );
            }
            foreach ($this->break_start as $index => $start) {
                $end = $this->break_end[$index] ?? null;
                if (empty($start) && empty($end)) {
                    continue;
                }
                if ($start < $this->start_time || $start > $this->end_time) {
                    $validator->errors()->add(
                        "break_start.$index",
                        '休憩時間が不適切な値です'
                    );
                }
                if ($end && $end > $this->end_time) {
                    $validator->errors()->add(
                        "break_end.$index",
                        '休憩時間もしくは退勤時間が不適切な値です'
                    );
                }
            }
        });
    }
}
