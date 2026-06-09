@extends('layouts.master')

<style>
    .form-box {
        background-color: #ffffff;
        border: 2px solid #000000;
        border-radius: 4px;
        padding: 25px;
        max-width: 650px;
        margin: 0 auto;
    }

    .form-box h3 {
        margin-top: 0;
        margin-bottom: 20px;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 2px solid #000000;
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group select, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #000000;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn-submit {
        background-color: #00FF90;
        color: #000000;
        font-weight: bold;
        padding: 10px 20px;
        border: 1px solid #000000;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #000000;
        color: #00FF90;
    }

    .btn-back {
        background-color: #ffffff;
        color: #000000;
        padding: 10px 20px;
        border: 1px solid #000000;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-back:hover {
        background-color: #f0f0f0;
    }
</style>

@section('content')
    <div class="form-box">
        <h3>Tạo bình luận mới</h3>

        <form action="{{ url('/comments') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Chọn tài khoản người viết</label>
                <select id="user_id" name="user_id" required>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->fullname }} ({{ $u->role }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="article_id">Chọn bài viết cần bình luận</label>
                <select id="article_id" name="article_id" required>
                    <option value="">-- Click chọn bài viết --</option>
                    @foreach($articles as $art)
                        <option value="{{ $art->id }}">{{ $art->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content">Nội dung văn bản</label>
                <textarea id="content" name="content" rows="4" placeholder="Nhập nội dung ý kiến đóng góp tại đây..." required>{{ old('content') }}</textarea>
                @error('content')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/comments') }}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Lưu bình luận</button>
            </div>
        </form>
    </div>
@endsection
