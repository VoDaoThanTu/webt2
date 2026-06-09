@extends('layouts.master')

<style>
    /* Khung hộp Form xanh đen đồng bộ */
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

    /* Các ô nhập dữ liệu nền tối - Không animation dãn nở */
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 12px;
        background-color: #0F131E;
        border: 1px solid #2D3748;
        color: #FFFFFF;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .form-group input:focus, .form-group textarea:focus {
        border-color: #00F0FF;
        outline: none;
    }

    /* Nút lưu phẳng tĩnh */
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

    /* Nút quay lại tĩnh */
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
        <h3>Thêm danh mục mới</h3>

        <form action="{{ url('/categories') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Thời sự, Kinh tế, Thể thao..." required>
                @error('name')
                <small class="text-danger fw-bold" style="display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="desc">Mô tả ngắn</label>
                <textarea id="desc" name="desc" rows="4" placeholder="Nhập vài dòng mô tả cho danh mục này...">{{ old('desc') }}</textarea>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="{{ url('/categories') }}" class="btn-back">Quay lại</a>
                <button type="submit" class="btn-submit">Lưu danh mục</button>
            </div>
        </form>
    </div>
@endsection
