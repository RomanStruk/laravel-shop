<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filter;
use Faker\Generator as Faker;

$factory->define(Filter::class, function (Faker $faker) {
    return [
        'id' => null,
        'value' => $faker->slug,
        'filter_group_id' => 1
    ];
});
