<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'city_code' => 1234,
        'email' => $faker->unique()->email,
        'type_delivery' => '',
        'pay_method' => ''
    ];
});
