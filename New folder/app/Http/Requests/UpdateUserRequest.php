<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('users')->ignore($userId)],
            'password' => 'nullable|string|min:6|confirmed',
            'full_name' => 'nullable|string|max:200',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'role' => 'required|in:admin,user',
            'current_level_id' => 'nullable|exists:levels,id',
            'target_score' => 'nullable|integer|min:0|max:990',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email',
            'username' => 'tên đăng nhập',
            'password' => 'mật khẩu',
            'full_name' => 'họ tên',
            'avatar' => 'ảnh đại diện',
            'role' => 'vai trò',
            'current_level_id' => 'mức độ hiện tại',
            'target_score' => 'điểm mục tiêu',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã được sử dụng',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'avatar.max' => 'Ảnh không được vượt quá 2MB',
        ];
    }
}
