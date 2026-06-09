<style>
    .sidebar {
        width: 270px;
        height: 100vh;
        background-color: #0F131E; /* Màu đen sâu */
        position: fixed;
        top: 0;
        left: 0;
        padding: 25px 20px;
        box-sizing: border-box;
        border-right: 1px solid #1E2640;
    }

    .sidebar .logo h2 {
        margin: 0 0 35px 0;
        font-size: 20px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #00F0FF; /* Xanh Cyan */
        border-bottom: 1px solid #1E2640;
        padding-bottom: 15px;
    }

    .sidebar .menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Tạo khung hình chữ nhật tĩnh, có viền bao quanh rõ ràng cho từng mục */
    .sidebar .menu ul li a {
        display: block;
        color: #94A3B8;
        background-color: #1E2640; /* Nền hộp menu */
        padding: 12px 18px;
        margin-bottom: 10px; /* Khoảng cách giữa các hộp */
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        border: 1px solid #2D3748; /* Viền hộp phân khu rõ ràng */
    }

    /* Hover đổi màu tĩnh lập tức, không có animation thụt thò hay hiệu ứng lướt */
    .sidebar .menu ul li a:hover {
        background-color: #00F0FF;
        color: #121824;
        border-color: #00F0FF;
    }

    /* Khối nút đăng xuất phẳng bên dưới */
    .logout {
        position: absolute;
        bottom: 25px;
        left: 20px;
        right: 20px;
    }

    .logout button {
        width: 100%;
        background-color: transparent;
        color: #EF4444;
        font-weight: bold;
        padding: 12px;
        border: 1px solid #EF4444;
        border-radius: 4px;
        text-transform: uppercase;
        cursor: pointer;
    }

    .logout button:hover {
        background-color: #EF4444;
        color: #FFFFFF;
    }
</style>

<aside class="sidebar">
    <div class="logo">
        <h2>The Tech Pulse</h2>
    </div>

    <nav class="menu">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Dashboard Admin</a></li>
            <li><a href="{{ url('/articles') }}">Quản lý bài viết</a></li>
            <li><a href="{{ url('/categories') }}">Quản lý danh mục</a></li>
            <li><a href="{{ url('/tags') }}">Quản lý thẻ (Tag)</a></li>
            <li><a href="{{ url('/comments') }}">Quản lý bình luận</a></li>
            <li><a href="{{ url('/users') }}">Quản lý người dùng</a></li>
            <li><a href="{{ url('/favorites') }}">Bài viết yêu thích</a></li>
        </ul>
    </nav>

    <div class="logout">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <button>Đăng xuất</button>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</aside>
