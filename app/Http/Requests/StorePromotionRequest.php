<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Hoặc thay đổi nếu bạn có logic authorization riêng
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:promotions,code',
            'description' => 'required|string|max:1000',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages()
    {
        return [
            'code.required' => 'Mã khuyến mãi là bắt buộc.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'description.required' => 'Mô tả là bắt buộc.',
            'discount_percentage.required' => 'Phần trăm giảm giá là bắt buộc.',
            'discount_percentage.numeric' => 'Phần trăm giảm giá phải là số.',
            'discount_percentage.min' => 'Phần trăm giảm giá không thể nhỏ hơn 0.',
            'discount_percentage.max' => 'Phần trăm giảm giá không thể lớn hơn 100.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là ngày hợp lệ.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.date' => 'Ngày kết thúc phải là ngày hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ];
    }
}
