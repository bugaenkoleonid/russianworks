<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Устанавливаем английскую локаль для Faker глобально
        $faker = Factory::create();
        $faker->locale('en_US');

        $this->call([
            ArticleSeeder::class,
            ArticleTagSeeder::class,
        ]);
    }
} 