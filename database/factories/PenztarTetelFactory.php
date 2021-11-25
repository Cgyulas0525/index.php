<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PenztarTetel;
use Faker\Generator as Faker;

$factory->define(PenztarTetel::class, function (Faker $faker) {

    return [
        'penztarfej_id' => $faker->randomDigitNotNull,
        'sorszam' => $faker->word,
        'termek_id' => $faker->randomDigitNotNull,
        'darab' => $faker->randomDigitNotNull,
        'netto' => $faker->randomDigitNotNull,
        'afa' => $faker->randomDigitNotNull,
        'brutto' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
