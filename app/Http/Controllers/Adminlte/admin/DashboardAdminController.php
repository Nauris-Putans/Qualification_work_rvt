<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Models\Adminlte\admin\DashboardAdmin;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Finds roles that are meant for user side
        $userRoles = DB::table('role_user')
            ->where('role_id', '<=' , 3)
            ->get();

        // Finds roles that are meant for admin side
        $memberRoles = DB::table('role_user')
            ->where('role_id', '>' , 3)
            ->get();

        // Retrieves all of the values for a given key
        $userRoles = $userRoles->pluck('user_id');
        $memberRoles = $memberRoles->pluck('user_id');

        // Finds users that have role_id meant for user side
        $usersCount = User::find($userRoles)->count();
        $memberCount = User::find($memberRoles)->count();

        $users = User::whereIn('id', $userRoles)->orderBy('id', 'desc')->take(8)->get();
        $members = User::whereIn('id', $memberRoles)->orderBy('id', 'desc')->take(8)->get();

        // Counts all tickets
        $ticketsCount = Ticket::all()->count();

        return view('adminlte.admin.index-admin', compact(  'users', 'members', 'usersCount', 'memberCount', 'memberRoles', 'ticketsCount', 'hashids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function show(DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function edit(DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function update(Request $request, DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function destroy(DashboardAdmin $dashboard)
    {
        //
    }
}
