<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Telepules;
use Faker\Generator as Faker;

$factory->define(Telepules::class, function (Faker $faker) {

    return [
        'iranyitoszam' => $faker->word,
        'telepules' => $faker->word,
        'megye' => $faker->word,
        'jaras' => $faker->word
    ];
});
