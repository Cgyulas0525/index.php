<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\szamlatetel;
use Faker\Generator as Faker;

$factory->define(szamlatetel::class, function (Faker $faker) {

    return [
        'szamla' => $faker->randomDigitNotNull,
        'termek' => $faker->randomDigitNotNull,
        'koltseg' => $faker->randomDigitNotNull,
        'afaszaz' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->randomDigitNotNull,
        'netto' => $faker->word,
        'afa' => $faker->word,
        'brutto' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
