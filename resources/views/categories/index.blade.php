@extends('layouts.master')

<style>
    /* Khung hộp quản lý nền xanh đen hi-tech phẳng lì */
    .manage-box {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    .manage-title {
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 25px;
        color: #FFFFFF;
        border-bottom: 1px solid #2D3748;
        padding-bottom: 15px;
        letter-spacing: 0.5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Nút thêm mới dạng khối phẳng, không animation */
    .btn-add {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        text-decoration: none;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-add:hover {
        background-color: #00D8E6;
    }

    /* Nút Sửa tĩnh hoàn toàn */
    .btn-action-edit {
        background-color: transparent;
        color: #00F0FF;
        border: 1px solid #00F0FF;
        padding: 6px 14px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-action-edit:hover {
        background-color: #00F0FF;
        color: #121824;
    }

    /* Nút Xóa tĩnh hoàn toàn */
    .btn-action-delete {
        background-color: transparent;
        color: #EF4444;
        border: 1px solid #EF4444;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background-color: #EF4444;
        color: #FFFFFF;
    }

    /* CẤU HÌNH BẢNG TỐI CHỐNG ẨN CHỮ */
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table-custom th {
        background-color: #0F131E;
        color: #94A3B8;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #2D3748;
        padding: 12px 10px;
        text-align: left;
    }

    /* Ép ruột bảng sang nền tối của hộp, chữ trắng sáng */
    .table-custom td {
        background-color: #1E2640;
        color: #E2E8F0;
        border-bottom: 1px solid #2D3748;
        padding: 14px 10px;
    }

    /* Fix cứng màu cho dòng thông báo trống để không bị tàng hình */
    .text-empty-state {
        color: #94A3B8 !important;
        font-weight: 500;
        font-style: italic;
        padding: 25px 0 !important;
    }
</style>

@section('content')
    <div class="manage-box">
        <div class="manage-title">
            <span>Quản lý danh mục bài viết</span>
            <a href="{{ url('/categories/create') }}" class="btn-add">+ Thêm danh mục</a>
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 30%;">Tên danh mục</th>
                <th>Mô tả tóm tắt</th>
                <th style="width: 20%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>#{{ $category->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $category->name }}</td>
                    <td style="color: #94A3B8;">{{ $category->desc ?? '(Trống)' }}</td>
                    <td class="text-center">
                        <a href="{{ url('/categories/'.$category->id.'/edit') }}" class="btn-action-edit">Sửa</a>

                        <form action="{{ url('/categories/'.$category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ông có chắc chắn muốn xóa danh mục này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-empty-state">
                        Chưa có danh mục nào được tạo trong hệ thống.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
