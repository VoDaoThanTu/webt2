@extends('reader.home')

<style>
    .profile-card {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }
    .profile-title {
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 25px;
        color: #FFFFFF;
        border-bottom: 1px solid #2D3748;
        padding-bottom: 15px;
        letter-spacing: 0.5px;
    }
    .form-group {
        margin-bottom: 22px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #94A3B8;
        font-size: 14px;
    }
    .form-group input {
        width: 100%;
        padding: 12px;
        background-color: #0F131E;
        border: 1px solid #2D3748;
        color: #FFFFFF;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-group input:focus {
        border-color: #00F0FF;
        outline: none;
    }
    .btn-update-profile {
        background-color: #00F0FF;
        color: #121824;
        border: none;
        padding: 12px 28px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
    }
    .btn-update-profile:hover {
        background-color: #00D8E6;
    }
</style>

@section('main_content')
    <div class="profile-card">
        <div class="profile-title">Hồ sơ cá nhân của tôi</div>

        @if(session('success'))
            <div class="alert alert-success" style="background-color: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; color: #10B981; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-weight: 600; font-size: 14px;">
                🎉 {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444; color: #EF4444; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <ul style="margin: 0; padding-left: 20px; font-weight: 600; font-size: 14px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/reader/profile/update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Vai trò thành viên</label>
                <input type="text" value="Độc giả hệ thống (Reader)" disabled style="background-color: #121824; color: #4A5568; cursor: not-allowed; border-color: #1E2640;">

                <div class="mt-2">
                    @if(Auth::user()->author_request == 0)
                        <span class="text-muted small">Tham gia đội ngũ bài viết ?</span>
                        <button type="button" onclick="event.preventDefault(); document.getElementById('form-request-author').submit();" class="btn btn-sm btn-outline-info ms-2" style="font-size: 12px; padding: 2px 10px;">Đăng ký làm Tác giả</button>
                    @elseif(Auth::user()->author_request == 1)
                        <span class="text-warning small fw-semibold">Chờ Admin duyệt</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="fullname">Họ và tên hiển thị <span class="text-danger">*</span></label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Địa chỉ Email tài khoản <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" id="password" name="password" placeholder=Nhập mật khẩu mới">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận lại mật khẩu mới</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
            </div>

            <div class="text-end pt-2">
                <button type="submit" class="btn-update-profile">Lưu thay đổi</button>
            </div>
        </form>
    </div>

    <form id="form-request-author" action="{{ url('/reader/request-author') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
