<?php

use Illuminate\Support\Facades\Route;

// Use middlewares here directly to avoid over-engineering
use App\Http\Middleware\RedirectIfLoggedOut;
use App\Http\Middleware\RedirectIfLoggedIn;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\LikeController;

// If the user's already logged in, no need to register or login again
Route::middleware(RedirectIfLoggedIn::class)->group(function () {
  Route::view('auth/register', 'auth.register')->name('auth.register.show');
  Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register.store');

  Route::view('auth/login', 'auth.login')->name('auth.login.show');
  Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.store');
});

// If logged out, disallow these routes
Route::middleware(RedirectIfLoggedOut::class)->group(function () {
  Route::delete('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

  Route::get('/', [PostController::class, 'show_friend_posts'])->name('home');
  Route::resource('post', PostController::class);

  Route::post('save-post/{post_id}', [SavedPostController::class, 'save'])->name('save-post');
  Route::get('saved-posts', [SavedPostController::class, 'index'])->name('saved-posts.index');
  Route::delete('unsave-post/{post_id}', [SavedPostController::class, 'destroy'])->name('unsave-post');

  Route::resource('user', UserController::class);
  Route::post('friend/store/{friend_id}', [UserController::class, 'add_friend'])->name('friend.store');

  Route::post('like/{post_id}', [LikeController::class, 'like'])->name('like');
  Route::delete('unlike/{post_id}', [LikeController::class, 'unlike'])->name('unlike');
});
