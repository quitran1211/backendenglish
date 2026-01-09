<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // 🔹 Lấy danh sách tất cả user
    public function list()
    {
        return response()->json(User::all());
    }

    // 🔹 Lấy 1 user theo query param ?id=1
    public function row(Request $request)
    {
        $id = $request->query('id');
        if (! $id) {
            return response()->json(['error' => 'ID is required'], 400);
        }

        $users = User::find($id);
        if (! $users) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($users);
    }

    // 🔹 Đăng ký user mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // ✅ Mã hóa mật khẩu
        $validated['password'] = bcrypt($validated['password']);
        // ✅ Tạo user
        $users = User::create($validated);

        return response()->json($users, 201);
    }

    // 🔹 Đăng nhập user
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string', // có thể là username hoặc email
            'password' => 'required|string',
        ]);

        // 🔹 Tìm user theo username hoặc email
        $users = User::where('email', $validated['login'])
            ->orWhere('username', $validated['login'])
            ->first();

        if (! $users || ! password_verify($validated['password'], $users->password)) {
            return response()->json(['message' => 'Tên đăng nhập hoặc mật khẩu không đúng'], 401);
        }

        // ✅ Đăng nhập thành công
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'user' => $users,
        ]);
    }

    // 🔹 Cập nhật thông tin user
    public function update(Request $request, $id)
    {
        // $user = User::findOrFail($id);

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'phone' => 'nullable|string|max:20',
        //     'address' => 'nullable|string|max:255',
        //     'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        // if ($request->hasFile('avatar')) {
        //     $file = $request->file('avatar');
        //     $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $path = 'users/avatars/' . $filename;

        //     // ✅ Lưu file mới vào thư mục storage/app/public/users/avatars
        //     Storage::disk('public')->put($path, file_get_contents($file));

        //     // ✅ Xóa ảnh cũ (nếu có)
        //     if ($user->avatar && $user->avatar !== 'users/avatars/default_avatar.png') {
        //         Storage::disk('public')->delete($user->avatar);
        //     }

        //     // ✅ Lưu đường dẫn có thể truy cập public
        //     $user->avatar = 'storage/' . $path;
        // } elseif (!$user->avatar) {
        //     $user->avatar = 'storage/users/avatars/default_avatar.png';
        // }

        // // ✅ Cập nhật các thông tin khác
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->address = $request->address;
        // $user->save();

        // // ✅ Trả về link ảnh đầy đủ (cho app / web dùng)
        // $user->avatar = asset($user->avatar);

        // return response()->json([
        //     'message' => 'User updated successfully!',
        //     'user' => $user,
        // ]);
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        // Kiểm tra mật khẩu cũ có đúng không
        if (! Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác!'], 400);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Đổi mật khẩu thành công!',
            'user' => $user,
        ]);
    }
}
