<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Koltsegcsoport;
use Faker\Generator as Faker;

$factory->define(Koltsegcsoport::class, function (Faker $faker) {

    return [
        'focsoport' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
