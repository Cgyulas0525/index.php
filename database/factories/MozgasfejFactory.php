<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mozgasfej;
use Faker\Generator as Faker;

$factory->define(Mozgasfej::class, function (Faker $faker) {

    return [
        'mozgaskod_id' => $faker->randomDigitNotNull,
        'datum' => $faker->word,
        'partner' => $faker->randomDigitNotNull,
        'bizszam' => $faker->word,
        'raktar' => $faker->randomDigitNotNull,
        'bf' => $faker->randomDigitNotNull,
        'feldolgozott' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
