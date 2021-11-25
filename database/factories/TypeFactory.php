<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'leiras' => $faker->text,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
