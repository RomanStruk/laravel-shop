<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'url' => '/storage/shop/none/uyl16PguDgQiPaDoL45hVTgZyRgc5Mfc7BeTseHH.jpeg',
        'extension' => 'jpeg',
        'path' => 'shop/none/uyl16PguDgQiPaDoL45hVTgZyRgc5Mfc7BeTseHH.jpeg',
        'size' => 1024,
        'visibility' => 'public',
        'disc' => 'public',
        'name' => $faker->unique()->slug,
        'keywords' => $faker->paragraph(1),
        'description' => $faker->paragraph(1),
    ];
});
