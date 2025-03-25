<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Main Pages
Route::get('/', [PagesController::class, 'index'])->name('home');

// Contact Routes (moved outside blog group)
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

Route::get('/care', [PagesController::class, 'care'])->name('care');
Route::get('/measure', [PagesController::class, 'measure'])->name('measure');
Route::get('/gifting', [PagesController::class, 'gifting'])->name('gifting');

// Comments routes
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
