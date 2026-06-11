<style>
    .sidebar-admin {
        width: 270px;
        height: 100vh;
        background-color: #0F131E;
        position: fixed;
        top: 0;
        left: 0;
        padding: 25px 20px;
        box-sizing: border-box;
        border-right: 1px solid #1E2640;
    }

    .sidebar-admin .logo h2 {
        margin: 0 0 35px 0;
        font-size: 20px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #00F0FF;
        border-bottom: 1px solid #1E2640;
        padding-bottom: 15px;
    }

    .sidebar-admin .menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-admin .menu ul li a {
        display: block;
        color: #94A3B8;
        background-color: #1E2640;
        padding: 12px 18px;
        margin-bottom: 10px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        border: 1px solid #2D3748;
    }

    /* Khi chỉ chuột vào, giữ nguyên màu nền tối và viền cũ, không làm sáng lên */
    .sidebar-admin .menu ul li a:hover {
        background-color: #242F4D; /* Chỉ sáng nhẹ một chút rất khó nhận ra */
        color: #94A3B8;            /* Giữ nguyên màu chữ xám */
        border-color: #2D3748;      /* Giữ nguyên màu viền */
    }

    .logout-box {
        position: absolute;
        bottom: 25px;
        left: 20px;
        right: 20px;
    }

    .logout-box button {
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

    .logout-box button:hover {
        background-color: #EF4444;
        color: #FFFFFF;
    }
</style>

<aside class="sidebar-admin">
    <div class="logo">
        <h2>Tech Pulse Admin</h2>
    </div>

    <nav class="menu">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Dashboard Admin</a></li>
            <li><a href="{{ url('/articles') }}">Quản lý bài viết</a></li>
            <li><a href="{{ url('/categories') }}">Quản lý danh mục</a></li>
            <li><a href="{{ url('/tags') }}">Quản lý thẻ </a></li>
            <li><a href="{{ url('/comments') }}">Quản lý bình luận</a></li>
            <li><a href="{{ url('/users') }}">Quản lý người dùng</a></li>
        </ul>
    </nav>

    <div class="logout-box">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
            <button>Đăng xuất</button>
        </a>
        <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</aside>
