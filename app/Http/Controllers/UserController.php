<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/login');
        }

        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = [
            'reader' => 'Độc giả (Reader)',
            'articles' => 'Tác giả (Author)',
            'admin' => 'Quản trị viên (Admin)'
        ];
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email    = $request->input('email');
        $user->role     = $request->input('role');
        $user->password = bcrypt('123456');
        $user->save();

        return redirect()->route('users.index');
    }

    public function approveAuthor($id)
    {
        $user = User::findOrFail($id);

        if ($user->author_request == 1) {
            $user->role = 'articles';
            $user->author_request = 0;
            $user->save();
        }
        return redirect()->back();
    }

    public function edit(User $user)
    {
        $roles = [
            'reader' => 'Độc giả (Reader)',
            'articles' => 'Tác giả (Author)',
            'admin' => 'Quản trị viên (Admin)'
        ];
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,articles,reader',
        ]);

        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
