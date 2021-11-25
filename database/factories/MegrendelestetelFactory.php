<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Megrendelestetel;
use Faker\Generator as Faker;

$factory->define(Megrendelestetel::class, function (Faker $faker) {

    return [
        'megrendelesfej' => $faker->randomDigitNotNull,
        'termek' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->randomDigitNotNull,
        'ertek' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
