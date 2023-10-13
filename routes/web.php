<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'articles');

Route::resource('/articles', ArticleController::class)->only(['index', 'show']);

Route::post('comments/store/{article}', [CommentController::class, 'store'])->name('comment.store');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/articles', AdminArticleController::class)->except('show');
});

require __DIR__.'/auth.php';
