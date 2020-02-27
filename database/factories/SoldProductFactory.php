<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SoldProduct;
use Faker\Generator as Faker;

$factory->define(SoldProduct::class, function (Faker $faker) {
    $rand = App\Product::orderByRaw('RAND()')->first();
    return [
        'product_id' => $rand->id,
        'product_price' => $rand->price,
        'order_id' => App\Order::orderByRaw('RAND()')->first()->id,
    ];
});
