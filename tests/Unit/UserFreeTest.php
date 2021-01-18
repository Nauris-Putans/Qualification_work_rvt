<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserFreeTest extends TestCase
{
//    /**
//     * UserFree can see dashboard section
//     */
//    public function testUserFreeCanSeeDashboard()
//    {
//        $user = UserFreeTest::createUser();
//        $this->actingAs($user);
//        $this->get('/user/dashboard')->assertStatus(200);
//        $user->delete();
//    }
//
//    /**
//     * UserFree cant see dashboard section
//     */
//    public function testUserFreeCantSeeDashboard()
//    {
//        $user = UserFreeTest::createUser();
//        $this->actingAs($user);
//        $this->get('/user/dashboard')->assertStatus(500);
//        $user->delete();
//    }

    /**
     * UserFree can see add monitor section
     */
    public function testUserFreeCanSeeAddMonitor()
    {
        $user = UserFreeTest::createUser();
        $this->actingAs($user);
        $this->get('/user/monitoring/monitors/add')->assertStatus(200);
        $user->delete();
    }

    /**
     * UserFree can see alerts section
     */
    public function testUserFreeCanSeeAlerts()
    {
        $user = UserFreeTest::createUser();
        $this->actingAs($user);
        $this->get('/user/alerts')->assertStatus(200);
        $user->delete();
    }

    /**
     * UserFree can see settings section
     */
    public function testUserFreeCanSeeSettings()
    {
        $user = UserFreeTest::createUser();
        $this->actingAs($user);
        $this->get('/user/settings')->assertStatus(200);
        $user->delete();
    }

    /**
     * UserFree can see support section
     */
    public function testUserFreeCanSeeSupport()
    {
        $user = UserFreeTest::createUser();
        $this->actingAs($user);
        $this->get('/user/support/tickets')->assertStatus(200);
        $user->delete();
    }

    /**
     * Creates test user with userFree role
     *
     * @return mixed
     */
    public function createUser()
    {
        $user = User::create([
            'id'                   => 9999,
            'name'                 => "Rihards Zaglis",
            'email'                => 'test@test.lv',
            'profile_image'        => null,
            'email_verified_at'    => now(),
            'password'             => Hash::make('1'),
            'phone_number'         => '+37111111111',
            'country'              => 69,
            'city'                 => "Kaļeningrad",
            'gender'               => "Male",
            'birthday'             => "2001-01-01",
            'remember_token'       => Str::random(10),
        ]);

        $role = DB::table('roles')
            ->where('id', 1)
            ->get();

        $role = $role->pluck('id');
        $user->syncRoles($role);

        return $user;
    }
}
