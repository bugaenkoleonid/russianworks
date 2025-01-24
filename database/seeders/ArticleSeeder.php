<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $title = fake()->sentence();
            Article::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => fake()->paragraphs(5, true),
                'image' => 'https://via.placeholder.com/800x400',
                'created_at' => fake()->dateTimeBetween('-1 year'),
            ]);
        }
    }
} 