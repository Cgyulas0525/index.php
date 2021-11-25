<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Modulidoszak;
use Faker\Generator as Faker;

$factory->define(Modulidoszak::class, function (Faker $faker) {

    return [
        'modul_id' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'dictionaries_id' => $faker->randomDigitNotNull,
        'hossz' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
