@extends('layouts.master')

@section('content')
    <div class="container-fluid pt-4">
        <div style="background-color: #1E2640; border: 1px solid #2D3748; border-radius: 8px; padding: 25px;">
            <h4 class="text-white mb-4" style="font-weight: 700; letter-spacing: 0.5px;">PHÊ DUYỆT ĐĂNG KÝ QUYỀN TÁC GIẢ</h4>

            @if(session('success'))
                <div class="alert alert-success bg-dark border-success text-success p-3 mb-3" style="font-weight: 600;">
                    🎉 {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle" style="border-color: #2D3748;">
                    <thead>
                    <tr class="text-muted" style="font-size: 14px;">
                        <th>STT</th>
                        <th>Họ và Tên thành viên</th>
                        <th>Địa chỉ Email</th>
                        <th>Ngày đăng ký hệ thống</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($requests as $key => $req)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-white fw-bold">{{ $req->fullname }}</td>
                            <td>{{ $req->email }}</td>
                            <td>{{ $req->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <form action="{{ url('/admin/author-requests/approve/'.$req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success fw-bold px-3">Phê duyệt quyền</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4 font-italic">Hiện tại không có yêu cầu nâng cấp quyền nào cần phê duyệt.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
