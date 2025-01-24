<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('articles.like');
Route::post('/articles/{article}/view', [ArticleController::class, 'view'])->name('articles.view');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
