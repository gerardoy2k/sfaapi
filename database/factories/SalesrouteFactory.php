<?php

use App\Branch;
use App\Salesroute;
use Faker\Generator as Faker;

$factory->define(Salesroute::class, function (Faker $faker) {
    return [
        'code' => $code = $faker->randomNumber($nbDigits = 6, $strict = false),
        'codeerp' => $faker->randomNumber($nbDigits = 8, $strict = false),
        'description' => str_random(40),
        'type' => $faker->randomElement(['P','A']), /* P:Preventa A:Autoventa*/
        'mobilepass' => $faker->word,
        'orderprefix' => $code,
        'salesoverinventory' => $faker->randomElement([true,false]),
        'allowchanges' => $faker->randomElement([true,false]),
        'allowdeposits' => $faker->randomElement([true,false]),
        'allowexportaccountsreceivable' => $faker->randomElement([true,false]),
        'allowexporthistory' => $faker->randomElement([true,false]),
        'status' => $faker->randomElement([true,false]),
        'branch_id' => Branch::all()->random()->id,
    ];
});