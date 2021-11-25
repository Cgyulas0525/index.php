<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mozgastetel;
use Faker\Generator as Faker;

$factory->define(Mozgastetel::class, function (Faker $faker) {

    return [
        'mozgasfej' => $faker->randomDigitNotNull,
        'termek' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
