<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', [PostController::class, 'index'])->name('home')->middleware('CheckIfLoggedIn');
Route::resource('/post', PostController::class);

Route::view('/auth/register', 'auth.register')->name('auth.register.show');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.store');

Route::view('/auth/login', 'auth.login')->name('auth.login.show');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.store');

Route::delete('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('/user', UserController::class);
