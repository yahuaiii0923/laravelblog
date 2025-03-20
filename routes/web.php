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
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::resource('blog', PostsController::class);
Route::post('/blog', [BlogController::class, 'store']);
Route::get('/blog/{slug}', [PostsController::class, 'show'])->name('posts.show');
//Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::get('/listing', [PagesController::class, 'listing'])->name('listing');

Route::get('/', [PagesController::class, 'index']);
Route::resource('/blog', PostsController::class);

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
