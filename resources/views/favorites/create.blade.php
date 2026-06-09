@extends('layouts.master')

<style>
    .form-box {
        background-color: #ffffff;
        border: 2px solid #000000;
        border-radius: 4px;
        padding: 25px;
        max-width: 550px;
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

    .form-group select {
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
        <h3>Tạo lượt thích bài viết</h3>

        <form action="{{ url('/favorites') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Chọn tài khoản thành viên</label>
                <select id="user_id" name="user_id" required>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="article_id">Chọn bài viết được thích</label>
                <select id="article_id" name="article_id" required>
                    <option value="">-- Chọn bài viết --</option>
                    @foreach($articles as $art)
                        <option value="{{ $art->id }}">{{ $art->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/favorites') }}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Lưu dữ liệu</button>
            </div>
        </form>
    </div>
@endsection
