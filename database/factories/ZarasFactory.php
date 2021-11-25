<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Zaras;
use Faker\Generator as Faker;

$factory->define(Zaras::class, function (Faker $faker) {

    return [
        'datum' => $faker->word,
        '5' => $faker->randomDigitNotNull,
        '10' => $faker->randomDigitNotNull,
        '20' => $faker->randomDigitNotNull,
        '50' => $faker->randomDigitNotNull,
        '100' => $faker->randomDigitNotNull,
        '200' => $faker->randomDigitNotNull,
        '500' => $faker->randomDigitNotNull,
        '1000' => $faker->randomDigitNotNull,
        '2000' => $faker->randomDigitNotNull,
        '5000' => $faker->randomDigitNotNull,
        '10000' => $faker->randomDigitNotNull,
        '20000' => $faker->randomDigitNotNull,
        'kartya' => $faker->randomDigitNotNull,
        'szep' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
