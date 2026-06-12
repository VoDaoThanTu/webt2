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
    }

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
            Quản lý bình luận
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 6%;">ID</th>
                <th style="width: 18%;">Người bình luận</th>
                <th style="width: 25%;">Thuộc bài viết</th>
                <th>Nội dung bình luận</th>
                <th style="width: 12%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>#{{ $comment->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $comment->user->fullname ?? 'Ẩn danh' }}</td>
                    <td class="text-truncate" style="max-width: 220px; color: #94A3B8;">{{ $comment->article->title ?? 'Bài viết đã xóa' }}</td>
                    <td style="color: #E2E8F0;">{{ $comment->content }}</td>
                    <td class="text-center">
                        <form action="{{ url('/comments/'.$comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ông có chắc chắn muốn xóa bỏ bình luận vi phạm này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-empty-state">
                        Hiện tại chưa có bình luận nào cần kiểm duyệt.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
