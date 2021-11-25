<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\termekfocsoport;
use Faker\Generator as Faker;

$factory->define(termekfocsoport::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'tsz' => $fakes->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
