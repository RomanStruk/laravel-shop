<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'brand_id' => 1,
        'title' => $faker->title,
        'alias' => $faker->unique()->slug,
        'content' => $faker->text,
        'price' => $faker->numberBetween(0 , 1000),
        'old_price' => $faker->numberBetween(0 , 1000),
        'status' => '1',
        'keywords' => 'watch',
        'description' => $faker->paragraph(1),
        'hit' => '0',
    ];
});
