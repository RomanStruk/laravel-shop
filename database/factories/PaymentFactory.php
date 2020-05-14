<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'paid' => $faker->randomElement([true, false]),
        'method' => $faker->randomElement(['receipt', 'google-pay', 'card']),
    ];
});
