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
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        color: #FFFFFF;
    }
    .table-custom th {
        background-color: #0F131E;
        color: #94A3B8;
        text-transform: uppercase;
        font-size: 13px;
        padding: 14px;
        border-bottom: 2px solid #2D3748;
        text-align: left;
    }
    .table-custom td {
        padding: 15px 14px;
        border-bottom: 1px solid #2D3748;
        background-color: #1E2640;
    }
</style>

@section('content')
    <div class="manage-box">
        <div class="manage-title">Binh luan</div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 20%;">Nguoi binh luan</th>
                <th>Noi dung thao luan</th>
                <th style="width: 35%;">Thuoc bai viet</th>
            </tr>
            </thead>
            <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td class="fw-bold" style="color: #00FF87;">
                        @if($comment->user)
                            {{ $comment->user->fullname }}
                        @else
                            Độc giả ẩn danh (ID: {{ $comment->user_id ?? 'Trống' }})
                        @endif
                    </td>
                    <td>{{ $comment->content }}</td>
                    <td style="color: #94A3B8; font-style: italic;">
                        {{ $comment->article->title ?? 'Bài viết đã bị xóa hoặc không tồn tại' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4" style="color: #94A3B8;">
                        Chưa có  bình luận trên các tác phẩm của bạn.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
