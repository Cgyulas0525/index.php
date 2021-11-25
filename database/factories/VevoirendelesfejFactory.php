<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vevoirendelesfej;
use Faker\Generator as Faker;

$factory->define(Vevoirendelesfej::class, function (Faker $faker) {

    return [
        'megrendelesszam' => $faker->word,
        'partner_id' => $faker->randomDigitNotNull,
        'mikor' => $faker->word,
        'mikorra' => $faker->word,
        'statusz' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
