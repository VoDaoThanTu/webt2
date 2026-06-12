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
        color: #64748B;
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
        .btn-submit {
        background-color: #00FF87 !important;
        color: #121824 !important;
    }
    .btn-submit:hover {
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
        <h3>{{ request()->is('author*') ? 'Dang bai viet moi' : 'Dang bai viet moi' }}</h3>

        <form action="{{ request()->is('author*') ? url('/author/articles/store') : url('/articles/store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="category_id">Thuoc danh muc <span class="text-danger">*</span></label>
                    <select id="category_id" name="category_id" required>
                        <option value="">-- Chon danh muc --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <label for="user_id">Nguoi dang bai<span class="text-danger">*</span></label>
                    @if(request()->is('author*'))
                        <input type="text" value="{{ Auth::user()->fullname }}" disabled>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    @else
                        <select id="user_id" name="user_id" required>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->fullname }} ({{ $u->role }})</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="title">Tieu de bai viet <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Nhap tieu de o day..." required>
                @error('title')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Hinh anh dai dien cho bai viet <span class="text-danger">*</span></label>
                <input type="file" id="image" name="image" accept="image/*" required>
                @error('image')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Noi dung bai viet <span class="text-danger">*</span></label>
                <textarea id="content" name="content" rows="10" placeholder="Viet noi dung bai viet o day..." required>{{ old('content') }}</textarea>
                @error('content')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Gan the cho bai viet</label>
                <div class="tag-checkbox-group">
                    @forelse($tags as $tag)
                        <label class="tag-item">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> #{{ $tag->name }}
                        </label>
                    @empty
                        <small style="color: #64748B; font-style: italic;">Chua gan the nao.</small>
                    @endforelse
                </div>
            </div>

            @if(request()->is('author*'))
                <input type="hidden" id="priority" name="priority" value="1">
            @else
                <div class="form-group" style="width: 50%;">
                    <label for="priority">Thu tu uu tien</label>
                    <input type="number" id="priority" name="priority" value="1" min="1">
                </div>
            @endif

            <div class="d-flex justify-content-between pt-3" style="border-top: 1px solid #2D3748;">
                <a href="{{ request()->is('author*') ? url('/author/articles') : url('/articles') }}" class="btn-back">Quay lai</a>
                <button type="submit" class="btn-submit">Xuat ban bai viet</button>
            </div>
        </form>
    </div>
@endsection
