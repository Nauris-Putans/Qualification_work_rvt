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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'test@inbox.lv',
            'password' => Hash::make('1'),
        ]);

        DB::table('users')->insert([
            'name' => 'User Admin (Free)',
            'email' => 'free@inbox.lv',
            'password' => Hash::make('1'),
        ]);

        DB::table('users')->insert([
            'name' => 'User Admin (Pro)',
            'email' => 'pro@inbox.lv',
            'password' => Hash::make('1'),
        ]);

        DB::table('users')->insert([
            'name' => 'Client',
            'email' => 'nauris-putans@inbox.lv',
            'password' => Hash::make('1'),
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
        ]);

        DB::table('roles')->insert([
            'name' => 'userFree',
            'display_name' => 'User Administrator (Free)',
        ]);

        DB::table('roles')->insert([
            'name' => 'userPro',
            'display_name' => 'User Administrator (Pro)',
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'user_type' => 'App\User'
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'user_type' => 'App\User'
        ]);

        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3,
            'user_type' => 'App\User'
        ]);
    }
}
