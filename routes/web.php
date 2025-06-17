<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
        Route::delete('/{post}/comments/{comment}', [CommentController::class, 'delete'])->name('posts.comments.delete');
    });
});

Route::prefix('profile')->middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/', '/profile/edit');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('admin.posts.index');
        Route::get('/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
        Route::post('/', [AdminPostController::class, 'store'])->name('admin.posts.store');
        Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{post}', [AdminPostController::class, 'delete'])->name('admin.posts.delete');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [AdminCategoryController::class, 'delete'])->name('admin.categories.delete');
    });
});

Route::fallback(function () {
    abort(404);
});
