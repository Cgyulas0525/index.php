<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Modulszuro;
use Faker\Generator as Faker;

$factory->define(Modulszuro::class, function (Faker $faker) {

    return [
        'modul_id' => $faker->randomDigitNotNull,
        'sorszam' => $faker->randomDigitNotNull,
        'nev' => $faker->word,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
