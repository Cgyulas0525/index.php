<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Kep;
use Faker\Generator as Faker;

$factory->define(Kep::class, function (Faker $faker) {

    return [
        'parent_id' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'dictionary_id' => $faker->randomDigitNotNull,
        'fokep' => $faker->randomDigitNotNull,
        'kep' => $faker->word,
        'kicsikep' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
