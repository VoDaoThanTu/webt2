<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->role = 'user';
        $user->password = Hash::make($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect()->route('client.home');
    }
}
