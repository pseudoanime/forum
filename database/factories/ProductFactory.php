<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'price' => $faker->randomNumber()
    ];
});
