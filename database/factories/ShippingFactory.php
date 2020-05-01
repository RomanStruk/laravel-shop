<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    $method = $faker->randomElement(['courier', 'novaposhta']);
    if ($method == 'courier'){
        $address = [
            'title' => $faker->streetAddress() .', буд. '.rand(1, 300). ' кв. '.rand(1, 9999),
            'code' => ''
        ];
    }else{
        $address = [
            'title' => 'Відділення №1: вул. Польова, 67 ',
            'code' => '169227f4-e1c2-11e3-8c4a-0050568002cf'
        ];
    }

    return [
        'order_id' => rand(1,5000),
        'shipping_rate' => rand(5, 50),

        'method' => $method,
        'city' => ['code' => 'e71f8842-4b33-11e4-ab6d-005056801329', 'title' => 'Харків, Харківська область'],
        'address' => $address,
    ];
});
