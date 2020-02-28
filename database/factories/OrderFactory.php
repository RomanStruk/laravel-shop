<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->email,
        'pay_method' => ''
    ];
});
