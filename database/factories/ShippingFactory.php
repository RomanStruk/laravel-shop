<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'order_id' => App\Order::orderByRaw('RAND()')->first()->id,
        'method' => $faker->randomElement(['courier', 'novaposhta']),
        'shipping_rate' => $faker->randomFloat(2, 0, 20),
    ];
});
