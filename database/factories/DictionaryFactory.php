<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dictionary;
use Faker\Generator as Faker;

$factory->define(Dictionary::class, function (Faker $faker) {

    return [
        'tipus_id' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'leiras' => $faker->text,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
