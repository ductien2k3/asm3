<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'schedule' => 'required|in:1,2',
            'location' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Vui lòng chọn khoá học',
            'course_id.exists' => 'Khoá học không tồn tại',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'schedule.required' => 'Vui lòng chọn lịch học',
            'schedule.in' => 'Lịch học không hợp lệ',
            'location.required' => 'Vui lòng nhập địa điểm',
            'location.string' => 'Địa điểm phải là một chuỗi ký tự',
            'location.max' => 'Địa điểm không được vượt quá 255 ký tự',
        ];
    }
}
