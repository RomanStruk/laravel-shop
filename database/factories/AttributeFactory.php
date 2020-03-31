<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use Faker\Generator as Faker;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
        'id' => null,
        'value' => $faker->slug,
        'filter_id' => 1
    ];
});
