<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

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
        return view('articles.create', ['categories' => $categories, 'users' => $users]);
    }

    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->priority = $request->input('priority', 1);
        $article->status = 1;
        $article->date_posted = now()->format('Y-m-d');
        $article->category_id = $request->input('category_id');
        $article->user_id = $request->input('user_id');
        $article->save();

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $users = User::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories, 'users' => $users]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->priority = $request->input('priority');
        $article->category_id = $request->input('category_id');
        $article->user_id = $request->input('user_id');
        $article->save();

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
