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

// Blog Routes
Route::prefix('blog')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/{slug}', [PostsController::class, 'show'])->name('posts.show');
    Route::get('/{slug}/edit', [PostsController::class, 'edit'])->name('blog.edit');
    Route::put('/{slug}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{slug}', [PostsController::class, 'destroy'])->name('blog.destroy');
    Route::get('/blog', [PostsController::class, 'index'])->name('blog.listing');
    Route::get('/blog/search', [PostsController::class, 'search'])->name('blog.search');
});

// Comments
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

// Authentication
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

