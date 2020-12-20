<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateCategoryTable();

        $categories = [
            [
                "name" => "Question",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Problem",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Job vacancie",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Other",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Truncates ticket table
     *
     * @return    void
     */
    public function truncateCategoryTable()
    {
        $this->command->info('Truncating Category table');
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
