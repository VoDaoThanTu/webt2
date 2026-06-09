<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Nếu chưa đăng nhập, sút thẳng về trang login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Kiểm tra vai trò tài khoản (Chỉ admin và author được vào vùng quản trị)
        $user = Auth::user();
        if ($user->role == 'admin' || $user->role == 'author') {
            return $next($request);
        }

        // 3. Nếu là độc giả thường (reader) mà bấm bừa đường link thì đá về trang chủ
        return redirect()->route('home');
    }
}
