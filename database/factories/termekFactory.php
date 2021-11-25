<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\termek;
use Faker\Generator as Faker;

$factory->define(termek::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'cikkszam' => $faker->word,
        'barcode' => $faker->word,
        'me' => $faker->randomDigitNotNull,
        'tsz' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->randomDigitNotNull,
        'minmenny' => $faker->randomDigitNotNull,
        'partner' => $faker->randomDigitNotNull,
        'glutenmentes' => $faker->randomDigitNotNull,
        'laktozmentes' => $faker->randomDigitNotNull,
        'tejmentes' => $faker->randomDigitNotNull,
        'tojasmentes' => $faker->randomDigitNotNull,
        'cukormentes' => $faker->randomDigitNotNull,
        'vegan' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'energiakj' => $faker->randomDigitNotNull,
        'energiakcal' => $faker->randomDigitNotNull,
        'zsir' => $faker->randomDigitNotNull,
        'telitett' => $faker->randomDigitNotNull,
        'szenhidrat' => $faker->randomDigitNotNull,
        'cukor' => $faker->randomDigitNotNull,
        'rost' => $faker->randomDigitNotNull,
        'feherje' => $faker->randomDigitNotNull,
        'so' => $faker->randomDigitNotNull,
        'osszetevok' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
