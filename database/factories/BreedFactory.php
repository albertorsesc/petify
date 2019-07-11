<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Breed;
use Faker\Generator as Faker;

$factory->define(Breed::class, function (Faker $faker) {
    return [
        'specie_id' => factory(\App\Models\Species::class)->create()->id,
        'name' => $faker->word,
        'status' => true,
    ];
});
