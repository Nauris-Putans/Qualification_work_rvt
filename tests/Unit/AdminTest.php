<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * Admin can see admin dashboard section
     */
    public function testAdminCanSeeAdminDashboard()
    {
        $user = AdminTest::createUser();
        $this->actingAs($user);
        $this->get('/admin/dashboard')->assertStatus(200);
        $user->delete();
    }

    /**
     * Admin can see admin users section
     */
    public function testAdminCanSeeAdminUsers()
    {
        $user = AdminTest::createUser();
        $this->actingAs($user);
        $this->get('/admin/users')->assertStatus(200);
        $user->delete();
    }

    /**
     * Admin can see Admin Team Members section
     */
    public function testAdminCanSeeAdminTeamMembers()
    {
        $user = AdminTest::createUser();
        $this->actingAs($user);
        $this->get('/admin/team/members')->assertStatus(200);
        $user->delete();
    }

    /**
     * Admin can see admin tickets section
     */
    public function testAdminCanSeeAdminTickets()
    {
        $user = AdminTest::createUser();
        $this->actingAs($user);
        $this->get('/admin/tickets')->assertStatus(200);
        $user->delete();
    }

    /**
     * Admin can see admin account settings section
     */
    public function testAdminCanSeeAdminAccountSettings()
    {
        $user = AdminTest::createUser();
        $this->actingAs($user);
        $this->get('/admin/settings')->assertStatus(200);
        $user->delete();
    }

    /**
     * Creates test user with admin role
     *
     * @return mixed
     */
    public function createUser()
    {
        $user = User::create([
            'id'                   => 9999,
            'name'                 => "Janis Abele",
            'email'                => 'test@test.lv',
            'profile_image'        => null,
            'email_verified_at'    => now(),
            'password'             => Hash::make('1'),
            'phone_number'         => '+37111111111',
            'country'              => 40,
            'city'                 => "Lietuva",
            'gender'               => "Male",
            'birthday'             => "2001-01-01",
            'remember_token'       => Str::random(10),
        ]);

        $role = DB::table('roles')
            ->where('id', 4)
            ->get();

        $role = $role->pluck('id');
        $user->syncRoles($role);

        return $user;
    }
}
