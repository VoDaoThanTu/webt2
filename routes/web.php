<?php

use Illuminate\Support\Facades\Route;

// IMPORT ĐẦY ĐỦ CÁC CONTROLLER HỆ THỐNG
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController; // Đã thêm import RegisterController
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReaderController;

// IMPORT MIDDLEWARE BẢO MẬT ADMIN
use App\Http\Middleware\CheckAdminLogin;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.handle');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.handle');

Route::middleware(['auth', CheckAdminLogin::class])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('/dashboard', [AdminController::class, 'index']);

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/approve/{id}', [ArticleController::class, 'approve'])->name('articles.approve');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/admin/author-requests', [UserController::class, 'authorRequests'])->name('admin.author_requests');
    Route::post('/admin/author-requests/approve/{id}', [UserController::class, 'approveAuthor'])->name('users.approve');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

});

Route::middleware(['auth'])
    ->prefix('author')
    ->as('author.')
    ->group(function () {

        Route::get('/articles', [ArticleController::class, 'authorIndex'])->name('articles.index');
        Route::get('/articles/create', [ArticleController::class, 'authorCreate'])->name('articles.create');
        Route::post('/articles/store', [ArticleController::class, 'authorStore'])->name('articles.store');
        Route::get('/articles/edit/{id}', [ArticleController::class, 'authorEdit'])->name('articles.edit');
        Route::post('/articles/update/{id}', [ArticleController::class, 'authorUpdate'])->name('articles.update');
        Route::get('/articles/delete/{id}', [ArticleController::class, 'authorDestroy'])->name('articles.destroy');

        Route::get('/dashboard', [AuthorController::class, 'dashboard'])->name('dashboard');
        Route::get('/comments', [AuthorController::class, 'comments'])->name('comments');
        Route::get('/profile', [AuthorController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AuthorController::class, 'profileUpdate'])->name('profile.update');

    });

Route::get('/home', [ReaderController::class, 'index'])->name('client.home');
Route::get('/article/{id}', [ReaderController::class, 'show'])->name('client.article');
Route::get('/client/category/{id}', [ReaderController::class, 'category'])->name('client.category');
Route::get('/client/tag/{id}', [ReaderController::class, 'tag'])->name('client.tag');
Route::get('/reader/history', [ReaderController::class, 'myHistory'])->name('reader.history');

Route::middleware(['auth'])->group(function () {
    Route::get('/article/like/{id}', [ReaderController::class, 'toggleLike'])->name('article.like');
    Route::post('/article/comment/{id}', [ReaderController::class, 'storeComment'])->name('article.comment');
    Route::get('/reader/favorites', [ReaderController::class, 'myFavorites'])->name('reader.favorites');
    Route::get('/reader/profile', [ReaderController::class, 'profile'])->name('reader.profile');
    Route::post('/reader/profile/update', [ReaderController::class, 'profileUpdate'])->name('reader.profile.update');

    Route::post('/reader/request-author', [ReaderController::class, 'requestAuthor'])->name('reader.request_author');
});


