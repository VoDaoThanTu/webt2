<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hàm hiển thị Form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Hàm xử lý kiểm tra thông tin đăng nhập từ Form gửi lên
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào bắt buộc
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Lấy dữ liệu email và password từ form
        $credentials = $request->only('email', 'password');

        // Sử dụng thư viện Auth gốc của Laravel để check với database
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, làm mới phiên làm việc (Session)
            $request->session()->regenerate();

            // Nhảy thẳng về trang chủ hệ thống
            return redirect()->route('home');
        }

        // Nếu sai tài khoản hoặc mật khẩu, trả về form kèm thông báo lỗi
        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Hàm xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        // Xóa sạch session cũ
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Đăng xuất xong đưa người dùng về trang chủ
        return redirect()->route('home');
    }
}
