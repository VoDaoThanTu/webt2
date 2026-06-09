@extends('layouts.master')

<style>
    .form-box {
        background-color: #ffffff;
        border: 2px solid #000000;
        border-radius: 4px;
        padding: 25px;
        max-width: 800px;
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

    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #000000;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Khung hộp bọc cụm checkbox cho đẹp mắt */
    .tag-checkbox-group {
        border: 1px solid #000000;
        border-radius: 4px;
        padding: 15px;
        background-color: #f9f9f9;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .tag-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: normal !important;
        cursor: pointer;
    }

    .tag-item input {
        width: auto !important;
        cursor: pointer;
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
        <h3>Đăng bài viết mới</h3>

        <form action="{{ url('/articles') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="category_id">Thuộc danh mục <span class="text-danger">*</span></label>
                    <select id="category_id" name="category_id" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <label for="user_id">Người đăng bài (Tác giả) <span class="text-danger">*</span></label>
                    <select id="user_id" name="user_id" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->fullname }} ({{ $u->role }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Tiêu đề bài viết <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Nội dung chi tiết bài viết <span class="text-danger">*</span></label>
                <textarea id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                @error('content')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Gán thẻ bài viết (Tags)</label>
                <div class="tag-checkbox-group">
                    @forelse($tags as $tag)
                        <label class="tag-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> #{{ $tag->name }}
                        </label>
                    @empty
                        <small class="text-muted">Chưa có thẻ tag nào trong hệ thống để chọn.</small>
                    @endforelse
                </div>
            </div>

            <div class="form-group" style="width: 50%;">
                <label for="priority">Thứ tự ưu tiên (Priority)</label>
                <input type="number" id="priority" name="priority" value="1" min="1">
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/articles') }}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Xuất bản bài viết</button>
            </div>
        </form>
    </div>
@endsection
