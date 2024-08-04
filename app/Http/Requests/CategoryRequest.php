<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => __('content.category.validation.name.required'),
            'name.string' => __('content.category.validation.name.string'),
            'name.max' => __('content.category.validation.name.max'),
            'description.required' => __('content.category.validation.description.required'),
            'description.string' => __('content.category.validation.description.string'),
            'description.max' => __('content.category.validation.description.max'),
        ];
    }

}
