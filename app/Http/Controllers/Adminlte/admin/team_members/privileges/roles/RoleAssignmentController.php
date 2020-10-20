<?php

namespace App\Http\Controllers\Adminlte\admin\team_members\privileges\roles;

use App\Role;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RoleAssignmentController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view ('adminlte.admin.team_members.privileges.roles.assign-role', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user);
        $role = Role::findOrFail($request->role);

        $user->syncRoles([$role->id]);
        return redirect()->back()->with('message', 'Successfully assigned user "' .$user->name. '" to role "'.$role->name.'"');
    }
}
