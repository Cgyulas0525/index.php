<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mozgaskod;
use Faker\Generator as Faker;

$factory->define(Mozgaskod::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'prefix' => $faker->word,
        'honnan' => $faker->randomDigitNotNull,
        'hova' => $faker->randomDigitNotNull,
        'pm' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
