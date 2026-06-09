<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; // Đã đổi từ HomeController sang AdminController chuẩn chỉnh
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ViewhistoryController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Màn hình trang chủ quản trị (Dashboard Admin)
Route::get('/', [AdminController::class, 'index'])->name('home');
Route::get('/dashboard', [AdminController::class, 'index']);

// 1. ROUTE QUẢN LÝ NGƯỜI DÙNG (USER)
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// 2. ROUTE QUẢN LÝ DANH MỤC (CATEGORY)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// 3. ROUTE QUẢN LÝ THẺ BÀI VIẾT (TAG)
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

// 4. ROUTE QUẢN LÝ BÀI VIẾT (ARTICLE)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// 5. ROUTE QUẢN LÝ BÌNH LUẬN (COMMENT)
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// 6. ROUTE BÀI VIẾT YÊU THÍCH (FAVORITE)
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::get('/favorites/create', [FavoriteController::class, 'create'])->name('favorites.create');
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
Route::get('/favorites/{favorite}/edit', [FavoriteController::class, 'edit'])->name('favorites.edit');
Route::put('/favorites/{favorite}', [FavoriteController::class, 'update'])->name('favorites.update');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

// 7. ROUTE CHI TIẾT LỊCH SỬ XEM (VIEWHISTORY)
Route::get('/viewhistories', [ViewhistoryController::class, 'index'])->name('viewhistories.index');
Route::get('/viewhistories/create', [ViewhistoryController::class, 'create'])->name('viewhistories.create');
Route::post('/viewhistories', [ViewhistoryController::class, 'store'])->name('viewhistories.store');
Route::get('/viewhistories/{viewhistory}/edit', [ViewhistoryController::class, 'edit'])->name('viewhistory.edit');
Route::put('/viewhistories/{viewhistory}', [ViewhistoryController::class, 'update'])->name('viewhistories.update');
Route::delete('/viewhistories/{viewhistory}', [ViewhistoryController::class, 'destroy'])->name('viewhistories.destroy');

// HỆ THỐNG XÁC THỰC TÀI KHOẢN (LOGIN / LOGOUT)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.handle');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
