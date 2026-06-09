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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Nút Thêm người dùng dạng khối phẳng tĩnh */
    .btn-add {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        text-decoration: none;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-add:hover {
        background-color: #00D8E6;
    }

    /* Nút Sửa dạng khối phẳng tĩnh */
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
    }

    /* Nút Xóa dạng khối phẳng tĩnh */
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

    .table-custom td {
        background-color: #1E2640;
        color: #E2E8F0;
        border-bottom: 1px solid #2D3748;
        padding: 14px 10px;
    }

    /* ĐỘ LẠI BADGE VAI TRÒ THEO TÔNG TECH */
    .role-badge-admin {
        background-color: rgba(239, 68, 68, 0.15);
        color: #EF4444;
        padding: 5px 10px;
        font-weight: 700;
        border-radius: 4px;
        font-size: 12px;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .role-badge-author {
        background-color: rgba(0, 240, 255, 0.15);
        color: #00F0FF;
        padding: 5px 10px;
        font-weight: 700;
        border-radius: 4px;
        font-size: 12px;
        border: 1px solid rgba(0, 240, 255, 0.3);
    }

    .role-badge-reader {
        background-color: #2D3748;
        color: #94A3B8;
        padding: 5px 10px;
        font-weight: 700;
        border-radius: 4px;
        font-size: 12px;
        border: 1px solid #4A5568;
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
            <span>Quản lý thành viên hệ thống</span>
            <a href="{{ url('/users/create') }}" class="btn-add">+ Thêm người dùng</a>
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th>Họ và Tên</th>
                <th>Địa chỉ Email</th>
                <th style="width: 20%;">Vai trò (Role)</th>
                <th style="width: 18%;" class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td class="fw-bold" style="color: #FFFFFF;">{{ $user->fullname }}</td>
                    <td style="color: #E2E8F0;">{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="role-badge-admin">Admin</span>
                        @elseif($user->role == 'author')
                            <span class="role-badge-author">Tác giả</span>
                        @else
                            <span class="role-badge-reader">Độc giả</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn-action-edit">Sửa</a>

                        <form action="{{ url('/users/'.$user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Có chắc chắn muốn xóa tài khoản này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-empty-state">
                        Hệ thống hiện tại trống rỗng, không có thành viên nào.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
