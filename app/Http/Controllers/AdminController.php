<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/login')->withErrors(['email' => 'Bạn không có quyền truy cập.']);
        }

        $count_articles   = Article::where('status', 1)->count();
        $count_pending    = Article::where('status', 0)->count();
        $count_users      = User::count();
        $count_categories = Category::count();
        $count_tags       = Tag::count();
        $count_comments   = Comment::count();

        $count_author_requests = User::where('author_request', 1)->count();

        return view('admin.dashboard', [
            'totalArticles'   => $count_articles,
            'pendingArticles' => $count_pending,
            'totalUsers'      => $count_users,
            'totalCategories' => $count_categories,
            'totalTags'       => $count_tags,
            'totalComments'   => $count_comments,
            'authorRequests'  => $count_author_requests
        ]);
    }

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 1;
        $article->save();

        return redirect()->back()->with('success', 'Phê duyệt và xuất bản bài viết thành công!');
    }
}
