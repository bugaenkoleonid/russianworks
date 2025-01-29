<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем теги используя фабрику
        Tag::factory()
            ->count(15)
            ->create();

        // Привязываем случайные теги к каждой статье
        Article::all()->each(function ($article) {
            $article->tags()->attach(
                Tag::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
} 