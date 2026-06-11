<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReaderController extends Controller
{
    public function __construct()
    {
        $shared_categories = Category::all();
        $shared_tags = Tag::all();
        view()->share(compact('shared_categories', 'shared_tags'));
    }

    public function index()
    {
        $featured = Article::where('status', 1)->orderBy('priority', 'desc')->latest()->take(3)->get();
        $articles = Article::where('status', 1)->latest()->paginate(6);
        return view('reader.index', compact('featured', 'articles'));
    }
    public function show($id)
    {
        $article = Article::where('status', 1)->with(['category', 'user', 'tags', 'comments.user'])->findOrFail($id);

        // --- LOGIC LƯU LỊCH SỬ ĐÃ XEM ---
        $history = session()->get('viewed_articles', []);
        if (!in_array($id, $history)) {
            array_unshift($history, $id);
            $history = array_slice($history, 0, 10);
            session()->put('viewed_articles', $history);
        }

        $isLiked = false;
        if (auth()->check()) {
            $isLiked = auth()->user()->favoriteArticles()->where('article_id', $id)->exists();
        }

        return view('reader.detail', compact('article', 'isLiked'));
    }

    public function toggleLike($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->favoriteArticles()->where('article_id', $id)->exists()) {
            $user->favoriteArticles()->detach($id);
        } else {
            $user->favoriteArticles()->attach($id, ['staydate' => now()]);
        }

        return redirect()->back();
    }

    public function storeComment(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate(['content' => 'required|string']);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->article_id = $id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->back();
    }
    public function myFavorites()
    {
        if (!Auth::check()) return redirect('/login');

        $articles = Auth::user()->favoriteArticles()->latest()->paginate(10);
        $page_title = "Bài viết yêu thích của tôi";

        return view('reader.list_articles', compact('articles', 'page_title'));
    }

    public function myHistory()
    {
        $historyIds = session()->get('viewed_articles', []);

        $articles = Article::where('status', 1)
            ->whereIn('id', $historyIds)
            ->orderByRaw("FIELD(id, " . implode(',', array_merge([0], $historyIds)) . ")")
            ->paginate(10);

        $page_title = "Lịch sử bài viết đã xem";

        return view('reader.list_articles', compact('articles', 'page_title'));
    }

    public function profile()
    {
        if (!Auth::check()) return redirect('/login');
        $user = Auth::user();
        return view('reader.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        return redirect()->back();
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $articles = Article::where('status', 1)->where('category_id', $id)->latest()->paginate(10);
        return view('reader.category', compact('category', 'articles'));
    }

    public function tag($id)
    {
        $tag = Tag::findOrFail($id);
        $articles = Article::where('status', 1)->whereHas('tags', function($q) use ($id) { $q->where('tag_id', $id); })->latest()->paginate(10);
        return view('reader.tag', compact('tag', 'articles'));
    }

    public function requestAuthor()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = User::findOrFail(Auth::id());
        $user->author_request = 1;
        $user->save();

        return redirect()->back()->with('success', 'Yêu cầu đã được gửi thành công! Vui lòng chờ phê duyệt.');
    }
}
