<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Syllable;
use Faker\Generator as Faker;

$factory->define(Syllable::class, function (Faker $faker) {
    return [
        'product_id' => null,
        'supplier_id' => null,
        'imported' => 1000,
        'remains' => 1000,
        'processed' => 0,
        'description' => null
    ];
});
