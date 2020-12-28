<?php

/** @var Factory $factory */

use App\Model;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$fakerEN = Faker\Factory::create('en_US');

$factory->define(Ticket::class, function (Faker\Generator $faker) use ($fakerEN)
{
    // Random priorities
    $priorities = array("Low", "Medium", "High");
    $random_priorities = array_rand($priorities);

    // Random actions
    $actions = array("Solved", "New Ticket", "Answered", "Un-Answered");
    $random_actions = array_rand($actions);

    // Random statuses
    $statuses = array("Opened", "Closed");
    $random_statuses = array_rand($statuses);

    return [
        'user_id' => $faker->numberBetween(5, 15),
        'category_id' => $faker->numberBetween(1, 3),
        'ticket_id' => strtoupper(Str::random(9)),
        'title' => $fakerEN->sentence,
        'priority' => $priorities[$random_priorities],
        'message' => $fakerEN->paragraph(2, true),
        'action' => $actions[$random_actions],
        'status' => $statuses[$random_statuses],
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
