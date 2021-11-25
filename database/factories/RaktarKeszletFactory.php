<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RaktarKeszlet;
use Faker\Generator as Faker;

$factory->define(RaktarKeszlet::class, function (Faker $faker) {

    return [
        'raktar_id' => $faker->randomDigitNotNull,
        'termek_id' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
