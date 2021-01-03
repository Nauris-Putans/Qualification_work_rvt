<?php

/** @var Factory $factory */

use App\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$fakerLV = Faker\Factory::create('lv_LV');

/** @var TYPE_NAME $factory */
$factory->define(User::class, function (\Faker\Generator $faker) use ($fakerLV)
{
    // Random gender
    $genders = array("Male", "Female");
    $random_genders = array_rand($genders);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('1'),
        'phone_number' => $fakerLV->phoneNumber,
        'country' => $faker->numberBetween(0, 195),
        'city' => $faker->city,
        'gender' => $genders[$random_genders],
        'birthday' => $faker->date('y-m-d'),
        'remember_token' => Str::random(10),
    ];
});
