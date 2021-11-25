<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Megrendelesfej;
use Faker\Generator as Faker;

$factory->define(Megrendelesfej::class, function (Faker $faker) {

    return [
        'datum' => $faker->word,
        'partner' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
