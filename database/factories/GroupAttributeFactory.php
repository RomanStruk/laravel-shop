<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GroupAttribute;
use Faker\Generator as Faker;

$factory->define(GroupAttribute::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->slug
    ];
});
