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

    .btn-update {
        background-color: #FFD000;
        color: #000000;
        font-weight: bold;
        padding: 10px 20px;
        border: 1px solid #000000;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-update:hover {
        background-color: #000000;
        color: #FFD000;
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
        <h3>Sửa nội dung bình luận</h3>

        <form action="{{ url('/comments/'.$comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">Thành viên</label>
                <select id="user_id" name="user_id" required>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ $u->id == $comment->user_id ? 'selected' : '' }}>
                            {{ $u->fullname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="article_id">Bài viết liên kết</label>
                <select id="article_id" name="article_id" required>
                    @foreach($articles as $art)
                        <option value="{{ $art->id }}" {{ $art->id == $comment->article_id ? 'selected' : '' }}>
                            {{ $art->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content">Nội dung bình luận</label>
                <textarea id="content" name="content" rows="4" required>{{ old('content', $comment->content) }}</textarea>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/comments') }}" class="btn-back">Hủy bỏ</a>
                <button type="submit" class="btn-update">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
