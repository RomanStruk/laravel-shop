<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserDetail;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
//        'user_id' => null,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
    ];
});
