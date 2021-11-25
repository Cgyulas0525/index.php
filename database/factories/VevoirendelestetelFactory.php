<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vevoirendelestetel;
use Faker\Generator as Faker;

$factory->define(Vevoirendelestetel::class, function (Faker $faker) {

    return [
        'vevoirendelesfej_id' => $faker->randomDigitNotNull,
        'termek_id' => $faker->randomDigitNotNull,
        'mennyiseg' => $faker->word,
        'atadott' => $faker->word,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
