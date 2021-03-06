<?php

use App\Role;
use App\Permission;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.roles_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = Role::firstOrCreate([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = Permission::firstOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            if(Config::get('laratrust_seeder.create_users')) {
                $this->command->info("Creating '{$key}' user");

                // Random gender
                $genders = array("Male", "Female");
                $random_genders = array_rand($genders);

                $fakerLV = Faker\Factory::create('lv_LV');
                $faker = Faker\Factory::create();

                // Create default user for each role
                $user = User::create([
                    'name' => ucwords(str_replace('_', ' ', $key)),
                    'email' => $key.'@inbox.lv',
                    'email_verified_at' => now(),
                    'password' => Hash::make('1'),
                    'phone_number' => $fakerLV->phoneNumber,
                    'country' => $faker->numberBetween(0, 195),
                    'city' => $faker->city,
                    'gender' => $genders[$random_genders],
                    'birthday' => $faker->date('y-m-d'),
                    'remember_token' => Str::random(10),
                ]);
                $user->attachRole($role);
            }

        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        if(Config::get('laratrust_seeder.truncate_tables')) {
            Role::truncate();
            Permission::truncate();
        }
        if(Config::get('laratrust_seeder.truncate_tables') && Config::get('laratrust_seeder.create_users')) {
            User::truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}
