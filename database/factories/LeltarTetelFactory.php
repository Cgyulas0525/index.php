<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LeltarTetel;
use Faker\Generator as Faker;

$factory->define(LeltarTetel::class, function (Faker $faker) {

    return [
        'leltarfej_id' => $faker->randomDigitNotNull,
        'termek_id' => $faker->randomDigitNotNull,
        'darab' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
