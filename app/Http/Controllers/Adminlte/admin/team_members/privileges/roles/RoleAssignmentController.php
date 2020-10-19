<?php

namespace App\Http\Controllers\Adminlte\admin\team_members\privileges\roles;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RoleAssignmentController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.admin.team_members.privileges.roles.assign-role');
    }
}
