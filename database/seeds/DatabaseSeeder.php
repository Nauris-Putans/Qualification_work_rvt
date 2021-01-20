<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(MonitoringSeeder::class);

        $this->call(CommentSeeder::class);

    }
}
