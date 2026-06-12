@extends('reader.home')

<style>
    .section-heading {
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        color: #00F0FF;
        border-left: 4px solid #00F0FF;
        padding-left: 12px;
        margin-bottom: 25px;
    }
    .article-row {
        display: flex;
        gap: 20px;
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        transition: transform 0.2s, border-color 0.2s;
    }
    .article-row:hover {
        transform: translateY(-2px);
        border-color: #00F0FF;
    }
    .article-thumb {
        width: 180px;
        height: 115px;
        object-fit: cover;
        border-radius: 6px;
        flex-shrink: 0;
    }
    .article-meta {
        font-size: 13px;
        color: #94A3B8;
        margin-bottom: 5px;
    }
    .article-link {
        color: #FFFFFF;
        font-size: 18px;
        font-weight: 700;
        text-decoration: none;
        line-height: 1.4;
        display: block;
    }
    .article-link:hover { color: #00F0FF; }
    .article-summary {
        color: #94A3B8;
        font-size: 14px;
        margin-top: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@section('main_content')
    <div class="section-heading">Tin tuc moi nhat</div>

    @forelse($articles as $art)
        <div class="article-row">
            <img src="{{ $art->image ? asset('uploads/articles/'.$art->image) : 'https://via.placeholder.com/180x115' }}" class="article-thumb" alt="Thumb">
            <div>
                <div class="article-meta">
                    <span class="text-info font-weight-bold">{{ $art->category->name ?? 'Chưa rõ' }}</span>
                    Dang boi: <span class="text-white">{{ $art->user->fullname ?? 'Ẩn danh' }}</span>
                    {{ $art->date_posted }}
                </div>
                <a href="{{ url('/article/'.$art->id) }}" class="article-link">
                    {{ $art->title }}
                </a>
                <div class="article-summary">
                    {{ strip_tags($art->content) }}
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5 italic" style="background-color: #1E2640; border: 1px solid #2D3748; border-radius: 8px;">
            Chưa có bài viết mới nào được xuất bản
        </div>
    @endforelse

    @if(isset($articles) && method_exists($articles, 'links'))
        <div class="d-flex justify-content-center mt-4 pagination-sm">
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection
