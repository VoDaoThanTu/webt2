@extends('layouts.master')

<style>
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

    .btn-update {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-update:hover {
        background-color: #00D8E6;
    }

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
        <h3>Sửa thành viên: {{ $user->fullname }}</h3>

        <form action="{{ url('/users/'.$user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fullname">Họ và Tên</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="role">Vai trò hệ thống</label>
                <select id="role" name="role" required>
                    @foreach($roles as $key => $value)
                        <option value="{{ $key }}" {{ old('role', $user->role) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/users') }}" class="btn-back">Hủy bỏ</a>
                <button type="submit" class="btn-update">Cập nhật tài khoản</button>
            </div>
        </form>
    </div>
@endsection
