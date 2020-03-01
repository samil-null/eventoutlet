<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'type' => 'gallery',
        'name' => random_int(1, 20) . '.jpg'
    ];
});
