<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Hoặc kiểm tra quyền admin
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:200',
            'topic' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_free' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'level_id' => 'mức độ',
            'title' => 'tiêu đề',
            'topic' => 'chủ đề',
            'description' => 'mô tả',
            'display_order' => 'thứ tự hiển thị',
            'is_free' => 'miễn phí',
            'is_active' => 'trạng thái',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'level_id.required' => 'Vui lòng chọn mức độ học',
            'level_id.exists' => 'Mức độ học không tồn tại',
            'title.required' => 'Vui lòng nhập tiêu đề bài học',
            'title.max' => 'Tiêu đề không được vượt quá 200 ký tự',
        ];
    }
}
