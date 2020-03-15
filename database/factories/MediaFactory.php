<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'url' => '/storage/avatars/7ceBz1f2tlqoXhgEe4QkfjHUmR8Neeh5uLwG0dnQ.jpeg',
        'extension' => 'jpeg',
        'path' => 'avatars/7ceBz1f2tlqoXhgEe4QkfjHUmR8Neeh5uLwG0dnQ.jpeg',
        'size' => 1024,
        'visibility' => 'public',
        'disc' => 'public',
        'name' => $faker->unique()->slug,
        'keywords' => $faker->paragraph(1),
        'description' => $faker->paragraph(1),
    ];
});
