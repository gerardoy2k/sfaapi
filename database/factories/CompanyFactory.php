<?php

use App\Company;
use App\Country;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'rif' => 'J-'.$faker->randomNumber($nbDigits = NULL, $strict = false),
        'address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'country_id' => Country::all()->random()->id,
        'status' => $faker->randomElement([0,1]),
    ];
});