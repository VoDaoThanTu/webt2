@extends('layouts.master')

<style>
    .form-box {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 30px;
        max-width: 800px;
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

    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px;
        background-color: #0F131E;
        border: 1px solid #2D3748;
        color: #FFFFFF;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #00F0FF;
        outline: none;
    }

    .form-group input:disabled {
        background-color: #1A202C;
        color: #4A5568;
        border-color: #2D3748;
        cursor: not-allowed;
    }

    .tag-checkbox-group {
        border: 1px solid #2D3748;
        border-radius: 6px;
        padding: 18px;
        background-color: #0F131E;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .tag-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500 !important;
        color: #E2E8F0;
        cursor: pointer;
    }

    .tag-item input {
        width: auto !important;
        accent-color: #00F0FF;
        cursor: pointer;
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

    @if(request()->is('author*'))
        .btn-update {
        background-color: #00FF87 !important;
        color: #121824 !important;
    }
    .btn-update:hover {
        background-color: #00E575 !important;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #00FF87 !important;
    }
    .tag-item input {
        accent-color: #00FF87 !important;
    }
    @endif
</style>

@section('content')
    <div class="form-box">
        <h3>{{ request()->is('author*') ? 'Chỉnh sửa bài viết (Tác giả)' : 'Điều chỉnh bài viết' }}</h3>

        @if(request()->is('author*'))
            <form action="{{ url('/author/articles/update/'.$article->id) }}" method="POST" enctype="multipart/form-data">
                @else
                    <form action="{{ url('/articles/'.$article->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @endif
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="category_id">Điều chỉnh danh mục</label>
                                <select id="category_id" name="category_id" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $article->category_id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tác giả bài viết</label>
                                <input type="text" value="{{ $article->user->fullname ?? 'Ẩn danh' }}" disabled>
                                <input type="hidden" name="user_id" value="{{ $article->user_id }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề bài viết</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Thay đổi hình ảnh đại diện</label>
                            @if($article->image)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/articles/' . $article->image) }}" alt="Old Thumb" style="width: 120px; height: 75px; object-fit: cover; border-radius: 4px; border: 1px solid #2D3748;">
                                    <small class="text-muted d-block mt-1">Hình ảnh hiện tại</small>
                                </div>
                            @endif
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung bài viết</label>
                            <textarea id="content" name="content" rows="8" required>{{ old('content', $article->content) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Gán lại thẻ bài viết (Tags)</label>
                            <div class="tag-checkbox-group">
                                @foreach($tags as $tag)
                                    <label class="tag-item">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                            {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        #{{ $tag->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        @if(request()->is('author*'))
                            <input type="hidden" id="priority" name="priority" value="{{ $article->priority }}">
                        @else
                            <div class="form-group" style="width: 50%;">
                                <label for="priority">Thiết lập độ ưu tiên hiển thị (Priority)</label>
                                <input type="number" id="priority" name="priority" value="{{ $article->priority }}" min="1">
                            </div>
                        @endif

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ request()->is('author*') ? url('/author/articles') : url('/articles') }}" class="btn-back">Hủy bỏ</a>
                            <button type="submit" class="btn-update">Lưu thay đổi</button>
                        </div>
                    </form>
    </div>
@endsection
