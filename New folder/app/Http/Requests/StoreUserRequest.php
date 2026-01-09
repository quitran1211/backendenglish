<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required|string|min:6|confirmed',
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
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'username.regex' => 'Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'avatar.image' => 'File phải là ảnh',
            'avatar.max' => 'Ảnh không được vượt quá 2MB',
            'role.required' => 'Vui lòng chọn vai trò',
            'target_score.max' => 'Điểm mục tiêu không được vượt quá 990',
        ];
    }
}
