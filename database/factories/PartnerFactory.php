<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'tipus' => $faker->randomDigitNotNull,
        'adoszam' => $faker->word,
        'bankszamla' => $faker->word,
        'isz' => $faker->word,
        'telepules' => $faker->randomDigitNotNull,
        'cim' => $faker->word,
        'email' => $faker->word,
        'telefonszam' => $faker->word,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
