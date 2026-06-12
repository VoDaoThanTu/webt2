@extends('layouts.master')

<style>
    .profile-card {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 30px;
        max-width: 650px;
        margin: 0 auto;
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
        border-color: #00FF87;
        outline: none;
    }
    .btn-update-profile {
        background-color: transparent;
        color: #00FF87;
        border: 1px solid #00FF87;
        padding: 12px 28px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
    }
    .btn-update-profile:hover {
        background-color: #00FF87;
        color: #121824;
    }
</style>

@section('content')
    <div class="profile-card">
        <div class="profile-title">Thong tin tac gia</div>

        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid #EF4444; color: #EF4444; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <ul style="margin: 0; padding-left: 20px; font-weight: 600;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/author/profile/update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Vai tro</label>
                <input type="text" value="Tac gia ( Author )" disabled style="background-color: #121824; color: #4A5568; cursor: not-allowed; border-color: #1E2640;">
            </div>

            <div class="form-group">
                <label for="fullname">Ho ten hien thi<span class="text-danger">*</span></label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Mat khau moi</label>
                <input type="password" id="password" name="password" placeholder="Nhap mat khau moi">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xac nhan mat khau moi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhap lai mat khau moi ">
            </div>

            <div class="text-end pt-2">
                <button type="submit" class="btn-update-profile">Cap nhat ho so</button>
            </div>
        </form>
    </div>
    </section>
