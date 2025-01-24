<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('articles', ArticleController::class)->only(['index', 'show', 'store']);
Route::post('articles/{article}/like', [ArticleController::class, 'like']);
Route::apiResource('comments', CommentController::class)->only(['store']); 