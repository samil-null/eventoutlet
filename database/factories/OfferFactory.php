<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'discount' => random_int(5, 70),
        'description' => $faker->text(random_int(100, 200)),
        'status' => random_int(0,2)
    ];
});
