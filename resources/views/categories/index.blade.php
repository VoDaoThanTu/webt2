@extends('layouts.master')

<style>
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

    .action-group {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .btn-action-edit {
        background-color: transparent;
        color: #00F0FF;
        border: 1px solid #00F0FF;
        padding: 6px 14px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        box-sizing: border-box;
    }

    .btn-action-edit:hover {
        background-color: #00F0FF;
        color: #121824;
    }

    .btn-action-delete {
        background-color: transparent;
        color: #EF4444;
        border: 1px solid #EF4444;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
    }

    .btn-action-delete:hover {
        background-color: #EF4444;
        color: #FFFFFF;
    }

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

    .table-custom td {
        background-color: #1E2640;
        color: #E2E8F0;
        border-bottom: 1px solid #2D3748;
        padding: 14px 10px;
        vertical-align: middle;
    }

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
                <th style="width: 22%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>#{{ $category->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $category->name }}</td>
                    <td style="color: #94A3B8;">{{ $category->desc ?? '(Trống)' }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ url('/categories/'.$category->id.'/edit') }}" class="btn-action-edit">Sửa</a>

                            <form action="{{ url('/categories/'.$category->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Chắc chắn muốn xóa danh mục này không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-delete">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-empty-state">
                        Chưa có danh mục nào được tạo
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
