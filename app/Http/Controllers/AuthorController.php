<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function dashboard()
    {
        $authorId = Auth::id();

        $myPublishedArticles = Article::where('user_id', $authorId)->where('status', 1)->count();

        $myPendingArticles = Article::where('user_id', $authorId)->where('status', 0)->count();

        $myCommentsCount = Comment::whereHas('article', function($query) use ($authorId) {
            $query->where('user_id', $authorId);
        })->count();

        return view('author.dashboard', [
            'totalArticles'   => $myPublishedArticles,
            'pendingArticles' => $myPendingArticles,
            'totalComments'   => $myCommentsCount
        ]);
    }

    public function comments()
    {
        $authorId = Auth::id();
        $comments = Comment::whereHas('article', function($query) use ($authorId) {
            $query->where('user_id', $authorId);
        })->with(['article', 'user'])->get();

        return view('author.comments', compact('comments'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('author.profile', compact('user'));
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
}
