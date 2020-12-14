<?php

/** @var Factory $factory */

use App\Model;
use App\Models\Adminlte\admin\Ticket;
use Illuminate\Database\Eloquent\Factory;

$fakerEN = Faker\Factory::create('en_US');

$factory->define(Ticket::class, function (Faker\Generator $faker) use ($fakerEN) {
    // Random message types
    $types = array("Question", "Problem", "Job vacancie", "Other");
    $random_types = array_rand($types);

    // Random actions
    $actions = array("Solved", "New Ticket", "Answered", "Un-Answered");
    $random_types = array_rand($actions);

    // Random statuses
    $statuses = array("Opened", "Closed");
    $random_statuses = array_rand($statuses);

    return [
        'title' => $fakerEN->sentence,
        'type' => $types[$random_types],
        'fullname' => $fakerEN->name,
        'email' => $fakerEN->unique()->safeEmail,
        'message' => $fakerEN->paragraph(2, true),
        'action' => $actions[$random_types],
        'status' => $statuses[$random_statuses],
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
