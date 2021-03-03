<?php

namespace App\Http\Controllers\Adminlte\admin\team;

use App\Models\Adminlte\admin\team\Member;
use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Finds roles that are meant for admin side
        $roles = DB::table('role_user')
            ->where('role_id', '>' , 3)
            ->get();

        // Retrieves all of the values for a given key
        $roles = $roles->pluck('user_id');

        // Finds users that have role_id meant for admin side
        $users = User::find($roles);

        return view('adminlte.admin.team.members', compact(  'users', 'hashids'));
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
     * @param  Member $member
     * @return Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Member $member
     * @return Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Member $member
     * @return Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Member $member
     * @return Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
