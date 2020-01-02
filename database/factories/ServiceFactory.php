<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use Faker\Generator as Faker;



$factory->define(Service::class, function (Faker $faker) {
    return [
        'price_option_id' => random_int(1,3),
        'name' => $faker->word,
        'price' => random_int(500,2000),
        'description' => $faker->text(random_int(50, 200))
    ];
});
