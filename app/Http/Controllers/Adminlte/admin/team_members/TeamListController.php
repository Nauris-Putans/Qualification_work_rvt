<?php

namespace App\Http\Controllers\Adminlte\admin\team_members;

use App\Models\Adminlte\admin\team_members\TeamList;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TeamListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.admin.team_members.team-members-list');
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
     * @param TeamList $teamList
     * @return Response
     */
    public function show(TeamList $teamList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TeamList $teamList
     * @return Response
     */
    public function edit(TeamList $teamList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TeamList $teamList
     * @return Response
     */
    public function update(Request $request, TeamList $teamList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TeamList $teamList
     * @return Response
     */
    public function destroy(TeamList $teamList)
    {
        //
    }
}
