<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Species;
use Faker\Generator as Faker;

$factory->define(Species::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
