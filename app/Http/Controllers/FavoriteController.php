<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['user', 'articles'])->get();
        return view('favorites.index', ['favorites' => $favorites]);
    }

    public function create()
    {
        $users = User::all();
        $articles = Article::all();
        return view('favorites.create', ['users' => $users, 'articles' => $articles]);
    }

    public function store(StoreFavoriteRequest $request)
    {
        $favorite = new Favorite();
        $favorite->staydate = now()->format('Y-m-d');
        $favorite->user_id = $request->input('user_id');
        $favorite->article_id = $request->input('article_id');
        $favorite->save();

        return redirect()->route('favorites.index');
    }

    public function edit(Favorite $favorite)
    {
        $users = User::all();
        $articles = Article::all();
        return view('favorites.edit', ['favorite' => $favorite, 'users' => $users, 'articles' => $articles]);
    }

    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        $favorite->user_id = $request->input('user_id');
        $favorite->article_id = $request->input('article_id');
        $favorite->save();

        return redirect()->route('favorites.index');
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return redirect()->route('favorites.index');
    }
}
