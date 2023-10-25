<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
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

Route::middleware(['auth', 'verified', 'throttle:60,1'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::resource('/post', PostController::class, ['only' => ['create', 'store', 'show', 'update', 'edit', 'destroy']]);
    Route::post('/posts/{post}/share', [PostController::class, 'share'])->name('share');
    Route::get('/posts/{post}/share/create', [PostController::class, 'createShare'])->name('share.create');

    Route::resource('/profile', ProfileController::class, ['only' => ['edit', 'update', 'show', 'store']])
        ->parameters(['profile' => 'user']);

    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('post.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');

    Route::get('/posts/{post}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/comment/{id}', [CommentController::class, 'update'])->name('comment.update');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::resource('/follow', FollowController::class)->only(['show', 'update', 'destroy'])
        ->parameters(['follow' => 'user']);

});

Route::middleware(['guest', 'throttle:60,1'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('welcome');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');


    Route::get('/password/reset', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');


    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/register/resend', [RegisterController::class, 'resendPage'])->name('resend');
    Route::post('/register/resend', [RegisterController::class, 'resendEmail'])->name('resend-verification-email');
    Route::get('/register/verify-email/{verification_code}', [RegisterController::class, 'verifyEmail'])->name('verify-email');
});
