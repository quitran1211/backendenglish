<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function dologin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        $credentials = filter_var($username, FILTER_VALIDATE_EMAIL)
            ? ['email' => $username, 'password' => $password]
            : ['username' => $username, 'password' => $password];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');
    }
}
