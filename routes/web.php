<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;

// Main Routes
Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'submitContact'])->name('contact.submit');

// Blog Routes
Route::prefix('blog')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/{slug}', [PostsController::class, 'show'])->name('posts.show');
    Route::get('/{slug}/edit', [PostsController::class, 'edit'])->name('blog.edit');
    Route::put('/{slug}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{slug}', [PostsController::class, 'destroy'])->name('blog.destroy');
    Route::get('/search', [PostsController::class, 'search'])->name('blog.search');
});

// Additional Pages
Route::get('/care', [PagesController::class, 'care'])->name('care');
Route::get('/measure', [PagesController::class, 'measure'])->name('measure');
Route::get('/gifting', [PagesController::class, 'gifting'])->name('gifting');

// Comments
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
     ->name('comments.store')
     ->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
     ->name('comments.destroy')
     ->middleware('auth');
Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike'])
     ->name('comments.like')
     ->middleware('auth');

// Authentication
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Matchmaker Routes
Route::get('/matchmaker', [PagesController::class, 'matchmaker'])->name('matchmaker');
Route::post('/matchmaker/process', [PagesController::class, 'processMatchmaker'])->name('matchmaker.process');
