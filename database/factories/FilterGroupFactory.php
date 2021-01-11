<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FilterGroup;
use Faker\Generator as Faker;

$factory->define(FilterGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->slug
    ];
});
