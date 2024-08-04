<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền thực hiện yêu cầu này không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Hoặc logic kiểm tra quyền truy cập nếu cần
    }

    /**
     * Xác thực dữ liệu đầu vào của yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'schedule' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    /**
     * Xác định thông điệp lỗi tùy chỉnh cho các quy tắc xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'image.image' => 'Ảnh không hợp lệ.',
            'image.mimes' => 'Ảnh phải là một tập tin loại: jpeg, png, jpg, gif.',
            'image.max' => 'Ảnh không được vượt quá 2048 kilobytes.',
            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'price.required' => 'Giá là bắt buộc.',
            'price.numeric' => 'Giá phải là một số.',
            'location.required' => 'Địa điểm là bắt buộc.',
            'location.string' => 'Địa điểm phải là một chuỗi.',
            'location.max' => 'Địa điểm không được vượt quá 255 ký tự.',
            'schedule.required' => 'Lịch học là bắt buộc.',
            'schedule.string' => 'Lịch học phải là một chuỗi.',
            'start_date.required' => 'Thời gian bắt đầu là bắt buộc.',
            'start_date.date' => 'Thời gian bắt đầu phải là một ngày hợp lệ.',
            'end_date.required' => 'Thời gian kết thúc là bắt buộc.',
            'end_date.date' => 'Thời gian kết thúc phải là một ngày hợp lệ.',
            'end_date.after_or_equal' => 'Thời gian kết thúc phải sau hoặc bằng thời gian bắt đầu.',
        ];
    }
}
