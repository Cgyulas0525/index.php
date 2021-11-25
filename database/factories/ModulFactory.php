<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Modul;
use Faker\Generator as Faker;

$factory->define(Modul::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
