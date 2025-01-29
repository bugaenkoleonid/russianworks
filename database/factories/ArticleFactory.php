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
        $this->faker->locale('en_US');
        
        $title = $this->faker->unique()->sentence(3);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => collect($this->faker->paragraphs(5))
                ->map(fn($paragraph) => "<p>{$paragraph}</p>")
                ->join(''),
            'image' => null,
            'views_count' => $this->faker->numberBetween(0, 1000),
            'likes_count' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
} 