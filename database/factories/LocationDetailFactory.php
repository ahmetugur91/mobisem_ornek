<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LocationDetail;
use Faker\Generator as Faker;

$factory->define(LocationDetail::class, function (Faker $faker) {
    return [
        "lat" => $faker->latitude,
        "lng" => $faker->longitude,
    ];
});
