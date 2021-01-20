<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\permissions;

use App\Permission;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PermissionAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Finds all permissions
        $permissions = Permission::all();

        // Finds all users
        $users = User::all();

        return view('adminlte.admin.team.privileges.permissions.assign-permission', compact('permissions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Finds user
        $user = User::findOrFail($request->user);

        // Finds permission
        $permission = Permission::findOrFail($request->permission);

        // Attaches permission to user
        $user->attachPermissions([$permission->id]);

        return redirect()->back()->with('message', 'Successfully assigned user "' .$user->name. '" to permission "'.$permission->name.'"');
    }
}
