<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\roles;

use App\Role;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
        $roles = Role::all();
        $users = User::all();

        return view ('adminlte.admin.team.privileges.roles.assign-role', compact('roles', 'users'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user);
        $role = Role::findOrFail($request->role);

        // Syncs role to user
        $user->syncRoles([$role->id]);

        return redirect()->back()->with('message', 'Successfully assigned user "' .$user->name. '" to role "'.$role->name.'"');
    }
}
