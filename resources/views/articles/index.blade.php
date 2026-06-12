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
        margin-bottom: 0;
        color: #FFFFFF;
        letter-spacing: 0.5px;
    }

    .btn-action-approve {
        background-color: transparent;
        color: #00FF87;
        border: 1px solid #00FF87;
        padding: 6px 14px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-action-approve:hover {
        background-color: #00FF87;
        color: #121824;
        border-color: #00FF87;
    }

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
        border-color: #00F0FF;
    }

    .btn-action-delete {
        background-color: transparent;
        color: #EF4444;
        border: 1px solid #EF4444;
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-action-delete:hover {
        background-color: #EF4444;
        color: #FFFFFF;
    }

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

    .badge-tech {
        background-color: rgba(0, 240, 255, 0.1);
        color: #00F0FF;
        border: 1px solid rgba(0, 240, 255, 0.2);
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .text-empty-state {
        color: #94A3B8 !important;
        font-weight: 500;
        font-style: italic;
        padding: 25px 0 !important;
    }

    @if(request()->is('author*'))
        .btn-action-edit {
        color: #00FF87 !important;
        border-color: #00FF87 !important;
    }
    .btn-action-edit:hover {
        background-color: #00FF87 !important;
        color: #121824 !important;
    }
    .badge-tech {
        background-color: rgba(0, 255, 135, 0.1) !important;
        color: #00FF87 !important;
        border-color: rgba(0, 255, 135, 0.2) !important;
    }
    @endif
</style>

@section('content')
    <div class="manage-box">

        <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 1px solid #2D3748;">
            <div class="manage-title">
                {{ request()->is('author*') ? 'Danh sach bai viet cua toi' : 'Quan ly danh sach bai viet' }}
            </div>

            @if(request()->is('author*'))
                <a href="{{ url('/author/articles/create') }}" class="btn btn-sm" style="background-color: #00FF87; color: #121824; font-weight: bold; padding: 8px 16px; text-decoration: none; border-radius: 4px;">+ Dang bai moi</a>
            @else
                <a href="{{ url('/articles/create') }}" class="btn btn-sm" style="background-color: #00F0FF; color: #121824; font-weight: bold; padding: 8px 16px; text-decoration: none; border-radius: 4px;">+ Them bai viet</a>
            @endif
        </div>

        <table class="table-custom">
            <thead>
            <tr>
                <th style="width: 6%;">ID</th>
                <th style="width: 14%;">Hinh anh</th>
                <th>Tieu de bai viet</th>
                <th style="width: 16%;">Danh muc</th>
                <th style="width: 14%;">Tac gia</th>
                <th style="width: 14%;">Trang thai</th>
                <th style="width: 22%;" class="text-center">Hanh dong</th>
            </tr>
            </thead>
            <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>#{{ $article->id }}</td>

                    <td>
                        @if($article->image)
                            <img src="{{ asset('uploads/articles/' . $article->image) }}" alt="Thumb" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #2D3748;">
                        @else
                            <span style="color: #64748B; font-size: 11px; font-style: italic;">Khong co anh</span>
                        @endif
                    </td>

                    <td class="fw-bold" style="color: #FFFFFF;">{{ $article->title }}</td>
                    <td>
                        <span class="badge-tech">
                            {{ $article->category->name ?? 'Chua ro' }}
                        </span>
                    </td>
                    <td style="color: #94A3B8;">{{ $article->user->fullname ?? 'An danh' }}</td>

                    <td>
                        @if($article->status == 1)
                            <span style="color: #00FF87; font-weight: 600;">Da xuat ban</span>
                        @else
                            <span style="color: #FFB800; font-weight: 600; font-style: italic;">Cho duyet</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if(request()->is('author*'))
                            <a href="{{ url('/author/articles/edit/'.$article->id) }}" class="btn-action-edit">Sua</a>
                            <a href="{{ url('/author/articles/delete/'.$article->id) }}" class="btn-action-delete" onclick="return confirm('Ban co chac muon xoa khong?')">Xoa</a>
                        @else
                            @if($article->status == 0)
                                <a href="{{ url('/articles/approve/'.$article->id) }}" class="btn-action-approve">Duyet bai</a>
                            @endif
                            <a href="{{ url('/articles/'.$article->id.'/edit') }}" class="btn-action-edit">Sua</a>
                            <form action="{{ url('/articles/'.$article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoa bai viet nay?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-delete">Xoa</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-empty-state">
                        Tac gia nay chua co bai viet
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
