@extends('layouts.master')

<style>
    .dashboard-title {
        margin-bottom: 35px;
        font-size: 26px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #FFFFFF;
        border-left: 4px solid #00F0FF;
        padding-left: 15px;
    }

    .card-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 40px;
    }

    /* Hộp thông số chuẩn chỉnh đồng bộ */
    .box-item {
        flex: 1;
        min-width: 200px;
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 22px;
        box-sizing: border-box;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .box-item h3 {
        margin: 0 0 12px 0;
        font-size: 14px;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .box-item .count {
        font-size: 36px;
        font-weight: 700;
        color: #00F0FF;
        margin: 0;
    }

    /* Nút bấm xem bài chờ duyệt đã đổi sang tông màu Cyan đồng bộ */
    .btn-check-pending {
        display: inline-block;
        background-color: transparent;
        color: #00F0FF;
        border: 1px solid #00F0FF;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
        margin-top: 15px;
        transition: all 0.3s;
    }

    .btn-check-pending:hover {
        background-color: #00F0FF;
        color: #121824;
    }
</style>

@section('content')

    <div class="dashboard-title">Hệ thống quản trị - The Tech Pulse</div>

    <div class="card-boxes">
        <div class="box-item">
            <h3>Bài viết công khai</h3>
            <p class="count">{{ $totalArticles }}</p>
        </div>

        <div class="box-item">
            <h3>Bài viết chờ duyệt</h3>
            <p class="count">{{ $pendingArticles }}</p>
        </div>

        <div class="box-item">
            <h3>Danh mục</h3>
            <p class="count">{{ $totalCategories }}</p>
        </div>

        <div class="box-item">
            <h3>Thẻ</h3>
            <p class="count">{{ $totalTags }}</p>
        </div>

        <div class="box-item">
            <h3>Bình luận</h3>
            <p class="count">{{ $totalComments }}</p>
        </div>

        <div class="box-item">
            <h3>Người dùng</h3>
            <p class="count">{{ $totalUsers }}</p>
        </div>

        <div class="box-item" style="border-color: #00F0FF; background-color: rgba(0, 240, 255, 0.02); padding: 20px; border-radius: 8px; border: 1px solid #2D3748;">
            <h3 style="color: #94A3B8; font-size: 14px; text-transform: uppercase;">Yêu cầu làm Tác giả</h3>
            <p class="count" style="color: #00F0FF; font-size: 36px; font-weight: 800; margin: 10px 0;">{{ $authorRequests }}</p>
            <a href="{{ url('/admin/author-requests') }}" class="btn-check" style="color: #00F0FF; text-decoration: none; font-size: 13px; font-weight: 600;">Xem chi tiết danh sách ➔</a>
        </div>
    </div>

@endsection
