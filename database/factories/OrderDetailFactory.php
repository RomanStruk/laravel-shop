<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => null,
        'date_added' => Carbon::now(),
        'comment' => 'Create',
        'status' => 'Pending',
    ];
});
