<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::resource('/post', PostController::class, ['only' => ['create', 'store', 'show', 'update', 'edit', 'destroy']]);
    Route::resource('/profile', ProfileController::class, ['only' => ['index', 'edit', 'update', 'show', 'store']]);
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');
    Route::get('/posts/{post}/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{postId}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'deleteComment'])->name('comment.delete');
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::resource('/follow', FollowController::class)->only(['show', 'update', 'destroy'])
        ->parameters(['follow' => 'user']);
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::get('/posts/{post}/share', [PostController::class, 'share'])->name('share');
});

Route::middleware(['guest', 'rate.limit', 'throttle:50,1'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('welcome');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/resend-verification-email', [RegisterController::class, 'resendEmail'])->name('resend-verification-email');
    Route::get('/register/verify-email/{verification_code}', [RegisterController::class, 'verifyEmail'])->name('verify_email');
});
