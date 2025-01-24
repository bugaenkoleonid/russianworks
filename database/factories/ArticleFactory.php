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
        $title = $this->faker->unique()->sentence(3);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(
                $this->faker->numberBetween(3, 7), 
                true
            ),
            'image' => null,
            'thumbnail' => null,
            'views_count' => $this->faker->numberBetween(0, 1000),
            'likes_count' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
} 