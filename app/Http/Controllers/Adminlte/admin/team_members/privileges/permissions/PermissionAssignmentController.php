<?php

namespace App\Http\Controllers\Adminlte\admin\team_members\privileges\permissions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionAssignmentController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.admin.team_members.privileges.permissions.assign-permission');
    }
}
