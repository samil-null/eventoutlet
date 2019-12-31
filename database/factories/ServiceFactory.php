<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use Faker\Generator as Faker;

$price_options = [
    'руб./ч.', 'руб./день', 'руб./шт.', 'фикс.'
];

$factory->define(Service::class, function (Faker $faker) use ($price_options) {
    return [
        'price_option' => $price_options[random_int(1,3)],
        'name' => $faker->word,
        'price' => random_int(500,2000),
        'description' => $faker->text(random_int(50, 200))
    ];
});
