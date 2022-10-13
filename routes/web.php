<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavedPostController;

Route::get('/', [PostController::class, 'show_friend_posts'])->name('home')->middleware('CheckIfLoggedIn');
Route::resource('/post', PostController::class);

// These names can be improved
Route::post('/save-post/{post_id}', [SavedPostController::class, 'save'])->name('save-post');
Route::get('/saved-posts', [SavedPostController::class, 'index'])->name('saved-posts.index');
Route::delete('/saved-posts/{post_id}', [SavedPostController::class, 'destroy'])->name('saved-posts.destroy');

Route::view('/auth/register', 'auth.register')->name('auth.register.show');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.store');

Route::view('/auth/login', 'auth.login')->name('auth.login.show');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.store');

Route::delete('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('/user', UserController::class);
Route::post('/friend/store/{friend_id}', [UserController::class, 'add_friend'])->name('friend.store');
