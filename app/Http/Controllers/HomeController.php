<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('articles'));
    }
} 