<?php

/** @var Factory $factory */

use App\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

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

$fakerLV = Faker\Factory::create('lv_LV');

$factory->define(User::class, function (\Faker\Generator $faker) use ($fakerLV) {
    // Random gender
    $genders = array("Male", "Female");
    $random_genders = array_rand($genders);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('1'), // password
        'phone_number' => $fakerLV->phoneNumber,
        'country' => $faker->numberBetween(0, 241),
        'city' => $faker->city,
        'gender' => $genders[$random_genders],
        'birthday' => $faker->date('y-m-d'),
        'remember_token' => Str::random(10),
    ];
});
