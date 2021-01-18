<?php

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ticket::class, 10)->create();
    }
}
