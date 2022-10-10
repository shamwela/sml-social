<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::view('/', 'post.index')->name('post.index');
Route::resource('/post', PostController::class);
