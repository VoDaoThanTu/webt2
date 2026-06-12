<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang tin tuc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: #0F131E;
            color: #E2E8F0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
        }
        .main-wrapper {
            flex: 1 0 auto;
        }

        .navbar-custom {
            background-color: #1E2640;
            border-bottom: 1px solid #2D3748;
            padding: 15px 0;
        }
        .navbar-logo {
            font-size: 22px;
            font-weight: 800;
            color: #00F0FF !important;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 1px;
        }

        .sidebar-box {
            background-color: #1E2640;
            border: 1px solid #2D3748;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .sidebar-title {
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            color: #FFFFFF;
            border-left: 3px solid #00F0FF;
            padding-left: 10px;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }
        .list-link-custom {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .list-link-custom li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(45, 55, 72, 0.5);
        }
        .list-link-custom li:last-child {
            border-bottom: none;
        }
        .list-link-custom a {
            color: #94A3B8;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .list-link-custom a:hover {
            color: #00F0FF;
            padding-left: 5px;
        }

        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .tag-item {
            background-color: #0F131E;
            color: #94A3B8;
            border: 1px solid #2D3748;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        .tag-item:hover {
            border-color: #00F0FF;
            color: #00F0FF;
        }

        .pagination .page-link {
            background-color: #1E2640 !important;
            border-color: #2D3748 !important;
            color: #00F0FF !important;
        }
        .pagination .page-item.active .page-link {
            background-color: #00F0FF !important;
            border-color: #00F0FF !important;
            color: #121824 !important;
            font-weight: bold;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #0F131E !important;
            color: #4A5568 !important;
            border-color: #2D3748 !important;
        }

        footer {
            flex-shrink: 0;
            background-color: #1E2640;
            border-top: 1px solid #2D3748;
            color: #64748B;
            padding: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <nav class="navbar-custom">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/home') }}" class="navbar-logo">The Tech Pulse</a>

            <div class="d-flex gap-3 align-items-center">
                @if(Auth::check())
                    <a href="{{ url('/reader/favorites') }}" class="text-decoration-none text-warning fw-semibold small">Yeu thich</a>
                    <a href="{{ url('/reader/history') }}" class="text-decoration-none text-info fw-semibold small">Lich su</a>
                    <a href="{{ url('/reader/profile') }}" class="text-decoration-none text-white fw-semibold small">Ho so</a>

                    <span class="pt-1 border-start ps-3 fw-bold" style="font-size: 14px; color: #00FF87; border-color: #2D3748 !important;"> {{ Auth::user()->fullname }}</span>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-info">Quan tri</a>
                    @elseif(Auth::user()->role === 'author' || Auth::user()->role === 'articles')
                        <a href="{{ url('/author/dashboard') }}" class="btn btn-sm btn-outline-success">Viet bai</a>
                    @endif

                    <form action="{{ url('/logout') }}" method="POST" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 12px; padding: 3px 8px;">Dang xuat</button>
                    </form>
                @else
                    <a href="{{ url('/reader/history') }}" class="text-decoration-none text-info fw-semibold small me-2">Lich su xem</a>
                    <a href="{{ url('/login') }}" class="btn btn-sm" style="background-color: #00F0FF; color: #121824; font-weight: bold;">Dang nhap</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row">

            <div class="col-lg-8">
                @yield('main_content')
            </div>

            <div class="col-lg-4">
                <div class="sidebar-box">
                    <div class="sidebar-title">Danh muc cong nghe</div>
                    <ul class="list-link-custom">
                        @forelse($shared_categories as $cat)
                            <li>
                                <a href="{{ url('/client/category/'.$cat->id) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @empty
                            <li class="text-muted font-italic">Chua co danh muc</li>
                        @endforelse
                    </ul>
                </div>

                <div class="sidebar-box">
                    <div class="sidebar-title">Tim kiem theo the</div>
                    <div class="tag-cloud">
                        @forelse($shared_tags as $t)
                            <a href="{{ url('/client/tag/'.$t->id) }}" class="tag-item">
                                # {{ $t->name }}
                            </a>
                        @empty
                            <span class="text-muted font-italic">Chua co the tag</span>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container">
        ©Dontcopyright  , cre by Hoang
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
