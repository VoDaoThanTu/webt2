<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])->get();
        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'users', 'tags'));
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->priority = $request->input('priority', 1);
        $article->status = 1;
        $article->date_posted = now()->format('Y-m-d');
        $article->category_id = $request->input('category_id');
        $article->user_id = $request->input('user_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/articles'), $fileName);
            $article->image = $fileName;
        }

        $article->save();

        if ($request->has('tags')) {
            $article->tags()->attach($request->input('tags'));
        }

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'users', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->priority = $request->input('priority');
        $article->category_id = $request->input('category_id');
        $article->user_id = $request->input('user_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/articles'), $fileName);
            $article->image = $fileName;
        }

        $article->save();

        if ($request->has('tags')) {
            $article->tags()->sync($request->input('tags'));
        }

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->status = 1;
        $article->save();

        return redirect()->back();
    }
    public function authorIndex()
    {
        $articles = Article::where('user_id', Auth::id())->with(['category', 'user'])->get();
        return view('articles.index', compact('articles'));
    }

    public function authorCreate()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create', compact('categories', 'tags'));
    }

    public function authorStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->priority = 1;

        $article->status = 0;

        $article->date_posted = now()->format('Y-m-d');
        $article->category_id = $request->input('category_id');
        $article->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/articles'), $fileName);
            $article->image = $fileName;
        }

        $article->save();

        if ($request->has('tags')) {
            $article->tags()->attach($request->input('tags'));
        }

        return redirect()->route('author.articles.index');
    }

    public function authorEdit($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }


    public function authorUpdate(Request $request, $id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/articles'), $fileName);
            $article->image = $fileName;
        }

        $article->save();

        if ($request->has('tags')) {
            $article->tags()->sync($request->input('tags'));
        }

        return redirect()->route('author.articles.index');
    }

    public function authorDestroy($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->delete();

        return redirect()->route('author.articles.index');
    }
}
