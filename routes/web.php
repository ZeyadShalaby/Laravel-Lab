<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;



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


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


Route::group(['middleware' => 'auth'], function () {

    // create new post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // show post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // edit post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // delete post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // restore post
    Route::patch('/posts/{post}', [PostController::class, 'restore'])->name('posts.restore');
});




Route::group(['middleware' => 'auth'], function () {

    // save comment
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // show a comment
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');

    // edit comment on a  post
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');

    // delete comment
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


// go to home
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/home', [PostController::class, 'index'])->name('posts.index');
?>