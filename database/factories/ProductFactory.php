<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => \App\Category::orderByRaw('RAND()')->first()->id,
        'brand_id' => '2',
        'title' => $faker->title,
        'alias' => $faker->unique()->slug,
        'content' => $faker->text,
        'price' => $faker->numberBetween(0 , 1000),
        'old_price' => $faker->numberBetween(0 , 1000),
        'status' => '1',
        'keywords' => 'watch',
        'description' => $faker->paragraph,
        'img' => '/img/products/4.jpg',
        'hit' => '0',
    ];
});
