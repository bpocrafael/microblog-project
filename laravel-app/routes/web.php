<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'verify' => true,
]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::resource('/post', PostController::class, ['only' => ['create', 'store', 'show', 'update', 'edit']]);
    Route::resource('/profile', ProfileController::class, ['only' => ['index', 'edit', 'update', 'show']]);
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');
    Route::get('/posts/{post}/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{postId}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
