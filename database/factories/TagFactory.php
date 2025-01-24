<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        $this->faker->locale('en_US');
        
        // Используем предопределенный список тегов для более реалистичных данных
        $tags = [
            'Technology', 'Programming', 'Web Development', 
            'Mobile', 'Design', 'UI/UX', 'Backend', 'Frontend',
            'DevOps', 'Security', 'Database', 'Cloud',
            'AI', 'Machine Learning', 'Data Science'
        ];
        
        $name = $this->faker->unique()->randomElement($tags);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
} 