<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\termekcsoport;
use Faker\Generator as Faker;

$factory->define(termekcsoport::class, function (Faker $faker) {

    return [
        'focsoport' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'afa' => $faker->randomDigitNotNull,
        'haszonkulcs' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
