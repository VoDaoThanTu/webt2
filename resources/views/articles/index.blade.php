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
    }

    /* Nút Sửa dạng khối phẳng tĩnh - Không animation */
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
        border-color: #00F0FF;
    }

    /* Nút Xóa dạng khối phẳng tĩnh - Không animation */
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

    /* CẤU HÌNH BẢNG TỐI PHẲNG CHỐNG ẨN CHỮ */
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

    /* Ép ruột bảng sang nền tối của hộp, chữ trắng sáng rõ mồn một */
    .table-custom td {
        background-color: #1E2640;
        color: #E2E8F0;
        border-bottom: 1px solid #2D3748;
        padding: 14px 10px;
    }

    /* Định dạng badge danh mục màu tối chữ Cyan phát sáng tĩnh */
    .badge-tech {
        background-color: rgba(0, 240, 255, 0.1);
        color: #00F0FF;
        border: 1px solid rgba(0, 240, 255, 0.2);
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
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
            Quản lý danh sách bài viết hệ thống
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th>Tiêu đề bài viết</th>
                <th style="width: 18%;">Danh mục</th>
                <th style="width: 15%;">Tác giả</th>
                <th style="width: 12%;">Độ ưu tiên</th>
                <th style="width: 18%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>#{{ $article->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $article->title }}</td>
                    <td>
                        <span class="badge-tech">
                            {{ $article->category->name ?? 'Chưa rõ' }}
                        </span>
                    </td>
                    <td style="color: #94A3B8;">{{ $article->user->fullname ?? 'Ẩn danh' }}</td>
                    <td><span style="color: #38BDF8; font-family: monospace;">Top {{ $article->priority }}</span></td>
                    <td class="text-center">
                        <a href="{{ url('/articles/'.$article->id.'/edit') }}" class="btn-action-edit">Sửa</a>

                        <form action="{{ url('/articles/'.$article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bài viết này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-empty-state">
                        Hiện tại hệ thống chưa có bài viết nào từ các tác giả.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
