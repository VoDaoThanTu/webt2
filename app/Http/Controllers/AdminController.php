<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Sử dụng hàm count() để database tự động đếm tổng số bản ghi hiện có
        $totalArticles = Article::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();

        // Bắn toàn bộ mớ số liệu tự động này sang file dashboard.blade.php
        return view('dashboard', compact(
            'totalArticles',
            'totalCategories',
            'totalTags',
            'totalComments',
            'totalUsers'
        ));
    }
}
