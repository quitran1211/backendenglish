<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Hoặc kiểm tra quyền truy cập
    }

    public function rules(): array
    {
        return [
            'message' => 'required|string|min:1|max:2000',
            'conversation_id' => 'nullable|string|exists:conversations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Tin nhắn không được để trống',
            'message.max' => 'Tin nhắn quá dài (tối đa 2000 ký tự)',
            'conversation_id.exists' => 'Cuộc hội thoại không tồn tại',
        ];
    }
}
