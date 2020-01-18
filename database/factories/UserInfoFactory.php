<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserInfo;
use Faker\Generator as Faker;

$factory->define(UserInfo::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'city_id' => random_int(1,4),
        'speciality_id' => random_int(1,4),
        'about_me' => $faker->text(random_int(350, 500)),
        'phone' => $faker->phoneNumber,
        'site' => $faker->word . '.ru',
        'vk' => 'vk.com/' . $faker->unique()->word,
        'whatsapp' => $faker->phoneNumber,
        'instagram' => '@'. $faker->unique()->word,
    ];
});
