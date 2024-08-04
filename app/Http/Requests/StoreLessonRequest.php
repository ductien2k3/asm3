<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền gửi yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Thay đổi nếu bạn có logic phân quyền
    }

    /**
     * Lấy các quy tắc xác thực cho yêu cầu này.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov',
            'content' => 'nullable|string',
        ];
    }

    /**
     * Tùy chọn xác thực lỗi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'course_id.required' => 'Khoá học là bắt buộc.',
            'course_id.exists' => 'Khoá học không tồn tại.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'video_url.url' => 'URL video không hợp lệ.',
            'video_file.file' => 'Tệp video không hợp lệ.',
            'video_file.mimes' => 'Tệp video phải có định dạng mp4, avi hoặc mov.',
            'content.string' => 'Nội dung phải là một chuỗi.',
        ];
    }
}
