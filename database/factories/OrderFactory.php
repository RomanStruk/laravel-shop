<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
//        'user_id' => function () {return factory(App\User::class)->create()->id;},
        'comment' => $faker->paragraph(),
        'status' => rand(1, 7),
        'created_at' => $faker->dateTimeBetween('-10 days', 'now'),
        'updated_at' => Carbon::now(),
    ];
});
