<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BlogController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/show/{post}', [PostController::class, 'show'])->name('post.show');

Route::prefix('post')->middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get("create", [PostController::class, 'create'])->name('post.create');
    Route::post("create", [PostController::class, 'store'])->name('post.store');
    Route::get("edit/{post}", [PostController::class, 'edit'])->name('post.edit');
    Route::put("edit/{post}", [PostController::class, 'update'])->name('post.update');
    Route::delete("delete/{post}", [PostController::class, 'destroy'])->name('post.delete');

    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
