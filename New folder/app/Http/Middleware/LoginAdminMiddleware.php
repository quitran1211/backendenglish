<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('admin');

        // Chưa đăng nhập admin
        if (! $guard->check()) {
            return redirect()->route('admin.login');
        }

        $user = $guard->user();

        // Không phải admin
        if (! $user || $user->role !== 'admin') {
            Auth::guard('admin')->logout();

            return redirect()
                ->route('admin.login')
                ->with('error', 'Không có quyền truy cập trang quản trị');
        }

        return $next($request);
    }
}
