<?php

/** @var Factory $factory */

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factory;

$fakerEN = Faker\Factory::create('en_US');

/** @var TYPE_NAME $factory */
$factory->define(Comment::class, function (Faker\Generator $faker) use ($fakerEN)
{
    return [
        'ticket_id' => $faker->numberBetween(1, 15),
        'user_id' => $faker->numberBetween(1, 15),
        'comment' => $fakerEN->word,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
