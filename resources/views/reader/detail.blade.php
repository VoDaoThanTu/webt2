@extends('reader.home')

<style>
    .detail-box {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        margin-bottom: 30px;
    }
    .detail-title {
        font-size: 28px;
        font-weight: 800;
        color: #FFFFFF;
        line-height: 1.4;
        margin-bottom: 15px;
    }
    .detail-meta {
        font-size: 14px;
        color: #94A3B8;
        border-bottom: 1px solid #2D3748;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .detail-img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 25px;
        border: 1px solid #2D3748;
    }
    .detail-content {
        color: #E2E8F0;
        font-size: 16px;
        line-height: 1.8;
    }

    .like-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #2D3748;
    }
    .btn-like {
        padding: 8px 20px;
        font-weight: 600;
        border-radius: 20px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .comment-section {
        background-color: #1E2640;
        border: 1px solid #2D3748;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }
    .comment-title {
        font-size: 18px;
        font-weight: 700;
        color: #00F0FF;
        text-transform: uppercase;
        border-bottom: 1px solid #2D3748;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .comment-form textarea {
        width: 100%;
        background-color: #0F131E;
        border: 1px solid #2D3748;
        color: #FFFFFF;
        padding: 12px;
        border-radius: 6px;
        resize: none;
    }
    .comment-form textarea:focus {
        border-color: #00F0FF;
        outline: none;
    }
    .btn-comment {
        background-color: #00F0FF;
        color: #121824;
        font-weight: 700;
        border: none;
        padding: 10px 22px;
        border-radius: 4px;
        cursor: pointer;
    }

    .comment-item {
        padding: 15px 0;
        border-bottom: 1px solid rgba(45, 55, 72, 0.6);
        background: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
    .btn-reply-toggle {
        background: none;
        border: none;
        color: #38BDF8;
        font-size: 12px;
        font-weight: 600;
        padding: 0;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-reply-toggle:hover {
        color: #00F0FF;
    }
    .reply-list {
        border-left: 2px solid #2D3748;
        padding-left: 15px;
        margin-top: 10px;
        margin-left: 5px;
    }
    .reply-item-content {
        padding: 5px 0;
        margin-bottom: 5px;
    }
</style>

@section('main_content')

    <div class="detail-box">
        <h1 class="detail-title">{{ $article->title }}</h1>

        <div class="detail-meta">
            <span class="text-info font-weight-bold">{{ $article->category->name ?? 'Chưa rõ' }}</span>
            Tác giả: <span class="text-white">{{ $article->user->fullname ?? 'Ẩn danh' }}</span>
            Ngày đăng: {{ $article->date_posted }}
        </div>

        @if($article->image)
            <img src="{{ asset('uploads/articles/'.$article->image) }}" class="detail-img" alt="Cover Image">
        @endif

        <div class="detail-content">
            {!! nl2br(e($article->content)) !!}
        </div>

        <div class="like-section text-end">
            @if(Auth::check())
                @if($isLiked)
                    <a href="{{ url('/article/like/'.$article->id) }}" class="btn-like bg-danger text-white">Đã thích bài viết</a>
                @else
                    <a href="{{ url('/article/like/'.$article->id) }}" class="btn-like btn-outline-light text-white border">Thích bài viết</a>
                @endif
            @else
                <a href="{{ url('/login') }}" class="btn-like btn-outline-light text-muted border">Đăng nhập để thích bài viết</a>
            @endif
        </div>
    </div>

    <div class="comment-section">
        <div class="comment-title">Bình luận từ độc giả</div>

        @if(Auth::check())
            <form action="{{ url('/article/comment/'.$article->id) }}" method="POST" class="comment-form mb-4">
                @csrf
                <div class="mb-3">
                    <textarea name="content" rows="3" placeholder="Chia sẻ ý kiến của bạn về bài viết này..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn-comment">Gửi bình luận</button>
                </div>
            </form>
        @else
            <div class="alert alert-secondary text-center mb-4" style="background-color: #0F131E; border-color: #2D3748; color: #94A3B8;">
                Bạn phải <a href="{{ url('/login') }}" class="text-info fw-bold text-decoration-none">Đăng nhập</a>
            </div>
        @endif

        <div class="comment-list">
            @forelse($article->comments->filter(function($c) { return $c->parent_id == null || $c->parent_id == 0; }) as $comment)
                <div class="comment-item">
                    <div class="d-flex justify-content-between mb-1" style="font-size: 13px;">
                        <strong style="color: #00F0FF;">{{ $comment->user->fullname ?? 'Độc giả ẩn danh' }}</strong>
                        <span style="color: #64748B;">{{ $comment->created_at->format('H:i d/m/Y') }}</span>
                    </div>
                    <div style="color: #E2E8F0; font-size: 14px; margin-bottom: 6px;">{{ $comment->content }}</div>

                    @if(Auth::check())
                        <div class="text-start">
                            <button type="button" class="btn-reply-toggle" onclick="toggleReplyForm({{ $comment->id }})">Phản hồi</button>
                        </div>

                        <form id="reply-form-{{ $comment->id }}" action="{{ url('/article/comment/'.$article->id) }}" method="POST" class="comment-form mt-2 d-none">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="mb-2">
                                <textarea name="content" rows="2" placeholder="Trả lời bình luận này..." style="font-size: 13px;" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-comment" style="padding: 5px 14px; font-size: 12px;">Gửi câu trả lời</button>
                            </div>
                        </form>
                    @endif

                    @if($comment->replies && $comment->replies->count() > 0)
                        <div class="reply-list">
                            @foreach($comment->replies as $reply)
                                <div class="reply-item-content">
                                    <div class="d-flex justify-content-between mb-1" style="font-size: 12px;">
                                        <strong style="color: #00FF87;">{{ $reply->user->fullname ?? 'Độc giả ẩn danh' }}</strong>
                                        <span style="color: #64748B;">{{ $reply->created_at->format('H:i d/m/Y') }}</span>
                                    </div>
                                    <div style="color: #E2E8F0; font-size: 13px;">{{ $reply->content }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center text-muted py-3 italic" style="font-size: 14px;">Bài viết chưa có bình luận nào</div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
            } else {
                form.classList.add('d-none');
            }
        }
    </script>

@endsection
