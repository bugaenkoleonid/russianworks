<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем 10 тегов
        Tag::factory()
            ->count(10)
            ->create();

        // Привязываем теги к статьям
        Article::all()->each(function ($article) {
            // Каждой статье назначаем от 1 до 4 случайных тегов
            $tagIds = Tag::inRandomOrder()
                ->take(rand(1, 4))
                ->pluck('id');
            
            $article->tags()->attach($tagIds);
        });
    }
} 