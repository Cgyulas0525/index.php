<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\szamla;
use Faker\Generator as Faker;

$factory->define(szamla::class, function (Faker $faker) {

    return [
        'partner' => $faker->randomDigitNotNull,
        'szamlaszam' => $faker->word,
        'fizitesimod' => $faker->randomDigitNotNull,
        'osszeg' => $faker->word,
        'kelt' => $faker->word,
        'teljesites' => $faker->word,
        'fizetesihatarido' => $faker->word,
        'feldolgozott' => $faker->randomDigitNotNull,
        'mozgasfej_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
