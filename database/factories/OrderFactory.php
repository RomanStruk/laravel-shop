<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
//        'user_id' => function () {return factory(App\User::class)->create()->id;},
        'comment' => $faker->paragraph(),
        'created_at' => $faker->dateTime(),
        'updated_at' => Carbon::now(),
    ];
});
