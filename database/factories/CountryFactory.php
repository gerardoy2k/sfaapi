<?php

use App\Country;
use Faker\Generator as Faker;


$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});