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

    /* Nút xóa dạng khối phẳng tĩnh hoàn toàn - Không animation rườm rà */
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

    /* ĐỊNH DẠNG BẢNG TỐI PHẲNG CHỐNG ẨN CHỮ */
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

    /* Ép ruột bảng sang nền tối của hộp, chữ sáng rõ mồn một không lo bị nấp màu */
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
            Nhật ký lịch sử xem bài viết (View Histories)
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 10%;">ID Log</th>
                <th style="width: 25%;">Tên độc giả</th>
                <th>Bài viết đã truy cập xem</th>
                <th style="width: 20%;">Thời gian xem</th>
                <th style="width: 12%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($viewhistories as $history)
                <tr>
                    <td>#{{ $history->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $history->user->fullname ?? 'Khách vãng lai' }}</td>
                    <td style="color: #00F0FF; font-weight: 600;">{{ $history->article->title ?? 'Bài viết đã xóa' }}</td>
                    <td class="text-muted font-monospace">{{ $history->created_at ?? 'Chưa rõ thời gian' }}</td>
                    <td class="text-center">
                        <form action="{{ url('/viewhistories/'.$history->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa dòng lịch sử xem này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-empty-state">
                        Hệ thống chưa ghi nhận lượt xem bài viết nào.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
