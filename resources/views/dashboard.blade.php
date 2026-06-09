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

    /* Hộp thông số công nghệ */
    .box-item {
        flex: 1;
        min-width: 200px;
        background-color: #1E2640; /* Nền xanh đen */
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 22px;
        box-sizing: border-box;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
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
        color: #00F0FF; /* Số đếm màu Cyan rực sáng */
        margin: 0;
    }
</style>

@section('content')

    <div class="dashboard-title">Hệ thống quản trị - The Tech Pulse</div>

    <div class="card-boxes">
        <div class="box-item">
            <h3>Bài viết</h3>
            <p class="count">{{ $totalArticles }}</p>
        </div>

        <div class="box-item">
            <h3>Danh mục</h3>
            <p class="count">{{ $totalCategories }}</p>
        </div>

        <div class="box-item">
            <h3>Thẻ (Tag)</h3>
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
    </div>

@endsection
