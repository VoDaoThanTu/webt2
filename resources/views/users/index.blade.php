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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-add {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .table-custom th {
        background-color: #151B2E;
        color: #94A3B8;
        text-align: left;
        padding: 12px 15px;
        font-size: 14px;
        text-transform: uppercase;
    }
    .table-custom td {
        padding: 12px 15px;
        border-bottom: 1px solid #2D3748;
        color: #E2E8F0;
        font-size: 15px;
    }
    .badge-role-admin { background-color: #EF4444; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
    .badge-role-author { background-color: #10B981; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
    .badge-role-reader { background-color: #4B5563; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; }

    .action-group { display: flex; gap: 8px; align-items: center; }
    .btn-action-approve { background-color: #00F0FF; color: #121824; border: none; padding: 5px 10px; border-radius: 4px; font-weight: 700; cursor: pointer; font-size: 13px; }
    .btn-action-edit { background-color: #F59E0B; color: #fff; text-decoration: none; padding: 5px 10px; border-radius: 4px; font-size: 13px; font-weight: 600; }
    .btn-action-delete { background-color: #DC2626; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 13px; }
</style>

@section('content')
    <div class="manage-box">
        <div class="manage-title">
            <span>Quan ly thanh vien</span>
            <a href="{{ url('/users/create') }}" class="btn-add">+ Them nguoi dung</a>
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th>Ho va ten</th>
                <th>Email</th>
                <th>Vai tro</th>
                <th>Hanh dong</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge-role-admin">Admin</span>
                        @elseif($user->role == 'articles')
                            <span class="badge-role-author">Tac gia</span>
                        @else
                            <span class="badge-role-reader">Doc gia</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            @if($user->author_request == 1)
                                <form action="{{ url('/admin/author-requests/approve/'.$user->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-action-approve">Duyet lam tac gia</button>
                                </form>
                            @endif

                            <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn-action-edit">Sua</a>
                            <form action="{{ url('/users/'.$user->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Co chac muon xoa khong?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-delete">Xoa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color: #64748B; padding: 30px 0;">
                        không có thành viên nào
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
