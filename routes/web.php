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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\SearchController;

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
  Route::post('friend/add/{friend_id}', [FriendController::class, 'add'])->name('friend.add');
  Route::post('friend/confirm/{friend_id}', [FriendController::class, 'confirm'])->name('friend.confirm');
  Route::delete('friend/delete/{friend_id}', [FriendController::class, 'delete'])->name('friend.delete');
  Route::get('friend-requests', [FriendController::class, 'show_friend_requests'])->name('friend-requests');

  Route::post('like/{post_id}', [LikeController::class, 'like'])->name('like');
  Route::delete('unlike/{post_id}', [LikeController::class, 'unlike'])->name('unlike');

  Route::post('comment/{post_id}', [CommentController::class, 'store'])->name('comment.store');

  Route::get('search', [SearchController::class, 'show'])->name('search');
  Route::view('menu', 'menu')->name('menu');
  Route::post('profile-picture', [UserController::class, 'update_profile_picture'])->name('profile-picture');
});
