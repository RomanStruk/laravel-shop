<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'order_id' => App\Order::orderByRaw('RAND()')->first()->id,
        'method' => $faker->randomElement(['courier', 'novaposhta']),
        'shipping_rate' => $faker->randomFloat(2, 0, 20),

        'address' => 'Пункт приймання-видачі (до 30 кг): вул. Незалежності, 32
                    Седлище, Незалежності, 32
                    Волинська область
                    Старовижівський р-н
                    ',
        'ref_code' => '0db4cb18-4b3a-11e4-ab6d-005056801329'
    ];
});
