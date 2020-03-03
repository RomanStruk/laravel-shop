<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'order_id' => App\Order::orderByRaw('RAND()')->first()->id,
        'method' => $faker->randomElement(['courier', 'novaposhta']),
        'shipping_rate' => $faker->randomFloat(2, 0, 20),
/*        'address' => $faker->randomElement(['Пункт приймання-видачі (до 30 кг): вул. Незалежності, 32
                    Седлище, Незалежності, 32
                    Волинська область
                    Старовижівський р-н', $faker->address()]),*/
        'city' => $faker->randomElement(['м. Берегове', 'м. Виноградів', 'м. Мукачево', 'м. Тячів']),
        'region' => $faker->randomElement(['Берегівський р-н', 'Виноградівський р-н', 'Міжгірський р-н', 'Тячівський р-н']),
        'area' => $faker->randomElement(['Вінницька область', 'Волинська область', 'Донецька область', 'Закарпатська область']),
        'city_ref' => 'e71992df-4b33-11e4-ab6d-005056801329',

        'street' => $faker->streetAddress(),
        'house' => $faker->numberBetween(1, 300),
        'flat' => $faker->numberBetween(1, 9999),

        'warehouse_ref' => '0db4cb18-4b3a-11e4-ab6d-005056801329',
        'warehouse_title' => 'Пункт приймання-видачі (до 30 кг): вул. Незалежності, 32'
    ];
});
