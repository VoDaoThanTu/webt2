<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'article'])->get();
        return view('comments.index', ['comments' => $comments]);
    }

    public function create()
    {
        $users = User::all();
        $articles = Article::all();
        return view('comments.create', ['users' => $users, 'articles' => $articles]);
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = $request->input('user_id');
        $comment->article_id = $request->input('article_id');
        $comment->save();

        return redirect()->route('comments.index');
    }

    public function edit(Comment $comment)
    {
        $users = User::all();
        $articles = Article::all();
        return view('comments.edit', ['comment' => $comment, 'users' => $users, 'articles' => $articles]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->content = $request->input('content');
        $comment->user_id = $request->input('user_id');
        $comment->article_id = $request->input('article_id');
        $comment->save();

        return redirect()->route('comments.index');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index');
    }
}
