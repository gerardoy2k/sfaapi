<?php

use App\Branch;
use App\Company;
use Faker\Generator as Faker;

$factory->define(App\Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'rif' => 'J-'.$faker->randomNumber($nbDigits = NULL, $strict = false),
        'address' => $faker->address,
        'phone' => $faker->tollFreePhoneNumber,
        'company_id' => Company::all()->random()->id,
        'status' => $faker->randomElement([0,1]),
    ];
});