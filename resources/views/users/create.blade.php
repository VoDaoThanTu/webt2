@extends('layouts.master')

<style>
    /* Khung hộp Form xanh đen đồng bộ phẳng lì */
    .form-box {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 30px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    .form-box h3 {
        margin-top: 0;
        margin-bottom: 25px;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 1px solid #2D3748;
        padding-bottom: 15px;
        color: #FFFFFF;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #94A3B8;
        font-size: 14px;
    }

    /* Ô nhập liệu tối chống ẩn chữ */
    .form-group input, .form-group select {
        width: 100%;
        padding: 12px;
        background-color: #0F131E;
        border: 1px solid #2D3748;
        color: #FFFFFF;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .form-group input:focus, .form-group select:focus {
        border-color: #00F0FF;
        outline: none;
    }

    /* Nút Tạo tài khoản màu Cyan phẳng */
    .btn-submit {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #00D8E6;
    }

    /* Nút quay lại */
    .btn-back {
        background-color: transparent;
        color: #94A3B8;
        padding: 12px 25px;
        border: 1px solid #2D3748;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-back:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #FFFFFF;
    }
</style>

@section('content')
    <div class="form-box">
        <h3>Tạo thành viên mới</h3>

        <form action="{{ url('/users') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="fullname">Họ và Tên</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                @error('fullname')
                <small class="text-danger fw-bold" style="display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <small class="text-danger fw-bold" style="display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu khởi tạo</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <small class="text-danger fw-bold" style="display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Vai trò hệ thống</label>
                <select id="role" name="role" required>
                    <option value="reader">Độc giả (Reader)</option>
                    <option value="author">Tác giả (Author)</option>
                    <option value="admin">Quản trị viên (Admin)</option>
                </select>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/users') }}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Tạo tài khoản</button>
            </div>
        </form>
    </div>
@endsection
