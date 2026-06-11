<?php

namespace App\Http\Controllers;

use App\Models\Viewhistory;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\StoreViewhistoryRequest;
use App\Http\Requests\UpdateViewhistoryRequest;

class ViewhistoryController extends Controller
{
    public function index()
    {
        $histories = Viewhistory::with(['user', 'articles'])->get();
        return view('viewhistories.index', ['histories' => $histories]);
    }

    public function create()
    {
        $users = User::all();
        $articles = Article::all();
        return view('viewhistories.create', ['users' => $users, 'articles' => $articles]);
    }

    public function store(StoreViewhistoryRequest $request)
    {
        $history = new Viewhistory();
        $history->viewtime = now();
        $history->user_id = $request->input('user_id');
        $history->article_id = $request->input('article_id');
        $history->save();

        return redirect()->route('viewhistories.index');
    }

    public function edit(Viewhistory $viewhistory)
    {
        $users = User::all();
        $articles = Article::all();
        return view('viewhistories.edit', ['viewhistory' => $viewhistory, 'users' => $users, 'articles' => $articles]);
    }

    public function update(UpdateViewhistoryRequest $request, Viewhistory $viewhistory)
    {
        $viewhistory->user_id = $request->input('user_id');
        $viewhistory->article_id = $request->input('article_id');
        $viewhistory->save();

        return redirect()->route('viewhistories.index');
    }

    public function destroy(Viewhistory $viewhistory)
    {
        $viewhistory->delete();
        return redirect()->route('viewhistories.index');
    }
}
