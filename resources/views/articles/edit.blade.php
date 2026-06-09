@extends('layouts.master')

<style>
    /* Khung hộp Form xanh đen */
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

    /* Các ô điền thông tin tối màu - Không hiệu ứng mượt khi chọn */
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

    /* Tài khoản tác giả bị khóa cứng */
    .form-group input:disabled {
        background-color: #1A202C;
        color: #4A5568;
        border-color: #2D3748;
        cursor: not-allowed;
    }

    /* Vùng chứa thẻ Tag */
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

    /* Nút bấm phẳng tĩnh hoàn toàn */
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
        <h3>Điều chỉnh bài viết (Quyền Admin)</h3>

        <form action="{{ url('/articles/'.$article->id) }}" method="POST">
            @csrf
            @method('PUT')

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

            <div class="form-group" style="width: 50%;">
                <label for="priority">Thiết lập độ ưu tiên hiển thị (Priority)</label>
                <input type="number" id="priority" name="priority" value="{{ $article->priority }}" min="1">
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/articles') }}" class="btn-back">Hủy bỏ</a>
                <button type="submit" class="btn-update">Lưu thay đổi</button>
            </div>
        </form>
    </div>
@endsection
