<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_US');
        $faker->addProvider(new \Faker\Provider\en_US\Text($faker));
        
        for ($i = 0; $i < 20; $i++) {
            $title = $faker->catchPhrase();
            
            Article::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->realText(1000),
                'created_at' => $faker->dateTimeBetween('-1 year'),
                'updated_at' => $faker->dateTimeBetween('-1 year'),
            ]);
        }
    }
} 