<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PenztarFej;
use Faker\Generator as Faker;

$factory->define(PenztarFej::class, function (Faker $faker) {

    return [
        'bizonylatszam' => $faker->word,
        'ertek' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
