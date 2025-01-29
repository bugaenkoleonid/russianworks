<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        // Создаем фейкер с английской локалью
        $faker = \Faker\Factory::create('en_US');
        
        // Генерируем технический заголовок на английском
        $title = $faker->realText(60);
        $title = ucfirst(trim(preg_replace('/[.!?]$/', '', $title)));
        
        // Генерируем содержимое из нескольких параграфов
        $paragraphs = [];
        $paragraphCount = $faker->numberBetween(3, 7);
        
        for ($i = 0; $i < $paragraphCount; $i++) {
            $paragraphs[] = $faker->realText($faker->numberBetween(200, 500));
        }
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => implode("\n", $paragraphs),
            'image' => null, // изначально null
            'views_count' => 0,
            'likes_count' => 0,
            'created_at' => now(),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }


    //присваивает картинке id статьи
    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $article->update(['image' => $article->id]);
        });
    }
} 