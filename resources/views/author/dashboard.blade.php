@extends('layouts.master')

@section('content')
    <div class="container-fluid" style="padding: 0;">
        <div class="mb-4">
            <h2 style="font-weight: 700; text-transform: uppercase; color: #00FF87; border-left: 4px solid #00FF87; padding-left: 15px;">Tổng quan của tôi</h2>
            <p class="text-muted mt-2">Chào mừng, Tác giả {{ Auth::user()->fullname }}!</p>
        </div>

        <div class="row g-3">

            <div class="col-md-4">
                <div class="dash-card" style="background: #1E2640; padding: 25px; border-radius: 8px; border: 1px solid #2D3748; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
                    <h4 style="color: #94A3B8; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Bài viết đã xuất bản</h4>
                    <div class="value" style="font-size: 36px; color: #00FF87; font-weight: bold;">{{ $totalArticles }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dash-card" style="background: #1E2640; padding: 25px; border-radius: 8px; border: 1px solid #2D3748; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
                    <h4 style="color: #94A3B8; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Bài viết chờ duyệt</h4>
                    <div class="value" style="font-size: 36px; color: #FFB800; font-weight: bold;">{{ $pendingArticles }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dash-card" style="background: #1E2640; padding: 25px; border-radius: 8px; border: 1px solid #2D3748; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);">
                    <h4 style="color: #94A3B8; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Bình luận của độc giả</h4>
                    <div class="value" style="font-size: 36px; color: #38BDF8; font-weight: bold;">{{ $totalComments }}</div>
                </div>
            </div>

        </div>
    </div>
@endsection
