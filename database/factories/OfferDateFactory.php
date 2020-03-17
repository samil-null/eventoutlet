<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OfferDate;
use Faker\Generator as Faker;

$factory->define(OfferDate::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeInInterval('-2 days', '50 days')
    ];
});
