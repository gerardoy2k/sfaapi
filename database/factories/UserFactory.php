<?php

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
	static $password;
	$branch = DB::table('branches')->where([['company_id', '=', '1']])->get()->random();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('xxxxxx'), // secret
        'remember_token' => str_random(10),
        'verified' => $verificado = $faker->randomElement([User::USER_VERIFIED,User::USER_NOT_VERIFIED]),
        'verification_token' => $verificado == User::USER_VERIFIED ? null : User::createVerificationToken(),
        'admin' => $faker->randomElement([User::USER_ADMIN,User::USER_NOT_ADMIN]),
        'country_id' => 1,
        'company_id' => 1,
        'branch_id' => $branch->id,
        'status' => $faker->randomElement([true,false]),
    ];
});






