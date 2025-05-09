<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
});
