<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('/post', PostController::class);

Route::view('/auth/register', 'auth.register')->name('auth.register.show');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.store');
