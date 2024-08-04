<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Hoặc bạn có thể thêm logic phân quyền nếu cần
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $userId = $this->route('id'); // Lấy ID người dùng từ route

        return [
            'role_id' => 'required|exists:roles,id',
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $userId,
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:8', // Mật khẩu là tùy chọn khi cập nhật
            'full_name' => 'required|string|max:255',
            'gender' => 'nullable|in:0,1', // Phải là 0 hoặc 1
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages()
    {
        return [
            'role_id.required' => 'Vui lòng chọn vai trò.',
            'role_id.exists' => 'Vai trò không tồn tại.',
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_name.unique' => 'Tên người dùng đã tồn tại.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'gender.in' => 'Giới tính không hợp lệ.',
            'image.image' => 'Ảnh không hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Ảnh không được lớn hơn 2MB.',
        ];
    }
}
