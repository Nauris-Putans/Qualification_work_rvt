<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\User::class, 11)
            ->create()
            ->each(function ($user) {
                $role = DB::table('roles')
                    ->where('id', 1)
                    ->get();
                $role = $role->pluck('id');
                $user->syncRoles($role);
            });

        $members = factory(\App\User::class, 11)
            ->create()
            ->each(function ($member) {
                $role = DB::table('roles')
                    ->where('id', '>' , 3)
                    ->get();
                $role = $role->pluck('id');
                $member->syncRoles($role);
            });
    }
}
