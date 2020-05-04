<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderHistory;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(OrderHistory::class, function (Faker $faker) {
    return [
        'order_id' => null,
        'user_id' => 1,
        'date_added' => Carbon::now(),
        'comment' => 'Create',
        'status' => '1',
    ];
});
