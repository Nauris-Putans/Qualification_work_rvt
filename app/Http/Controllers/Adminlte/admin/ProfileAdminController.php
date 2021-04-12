<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Country;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Stripe\Customer;
use Stripe\Issuing\Transaction;
use Stripe\PaymentMethod;

class ProfileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($id)
    {
        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds user by user id
        $user = User::find($id)->first();

        // Get country id from $user
        $countryID = $user->pluck('country');

        // Finds country by $countryID
        $countryName = Country::find($countryID);

        // Finds user_id from table 'role_user' by user id
        $roleID = DB::table('role_user')
            ->where('user_id', $id)
            ->first();

        // Finds id from table 'roles' by $roleID variable
        $role = DB::table('roles')
            ->where('id', $roleID->role_id)
            ->first();

        $invoices = $user->invoices();

        // Sets current language to $locale
        $locale = Config::get('app.locale');

        // Sets locale for all data types (php)
        setlocale(LC_ALL, $locale . '_' . strtoupper($locale), $locale);

        return view('adminlte.admin.profile-admin', compact('user', 'role', 'countryName', 'invoices'));
    }
}
