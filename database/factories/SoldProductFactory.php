<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SoldProduct;
use Faker\Generator as Faker;

$factory->define(SoldProduct::class, function (Faker $faker) {
    return [
        'product_id' => 1,
        'sale_price' => 0,
        'created_at' => $faker->dateTimeBetween('-10 days', 'now'),
    ];
});
