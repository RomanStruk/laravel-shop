<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $status = rand(1, 7);
    if ($status != App\Order::STATUS_COMPLETED){
        $status = rand(1, 7);
    }
    if ($status != App\Order::STATUS_COMPLETED){
        $status = rand(1, 7);
    }
    if ($status != App\Order::STATUS_COMPLETED){
        $status = rand(1, 7);
    }
    if ($status != App\Order::STATUS_COMPLETED){
        $status = rand(1, 7);
    }
    $time = $faker->dateTimeBetween('-2 months', 'now');
    if ($time->format('d') == '29' and $time->format('m') == '03' and $time->format('H') == '02'){
        $time = '2020-03-28 02:00:39';
    }
    return [
//        'user_id' => function () {return factory(App\User::class)->create()->id;},
        'comment' => $faker->paragraph(),
        'status' => $status,
        'created_at' => $time,
        'updated_at' => Carbon::now(),
    ];
});
