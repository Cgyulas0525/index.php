<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LeltarFej;
use Faker\Generator as Faker;

$factory->define(LeltarFej::class, function (Faker $faker) {

    return [
        'datum' => $faker->word,
        'raktar_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
