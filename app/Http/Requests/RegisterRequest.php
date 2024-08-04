<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Xác thực người dùng có quyền thực hiện yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Đảm bảo rằng tất cả người dùng đều có quyền thực hiện yêu cầu này
    }

    /**
     * Xác thực dữ liệu đầu vào.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|string|max:50',
            'full_name' => 'required|string|max:200',
            'email' => 'required|email|max:100',
            'pass' => 'required|string|max:100',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'pass.required' => 'Mật khẩu là bắt buộc.',
        ];
    }
}
