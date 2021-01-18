<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\roles;

use App\Http\Requests\RoleAssignRequest;
use App\Role;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Finds roles that are meant for admin side
        $rolesAttr = DB::table('role_user')
            ->where('role_id', '>' , 3)
            ->get();

        // Finds roles info that are meant for admin side
        $rolesID = DB::table('roles')
            ->where('id', '>' , 3)
            ->get();

        // Retrieves all of the values for a given key
        $rolesID = $rolesID->pluck('id');
        $usersID = $rolesAttr->pluck('user_id');

        // Finds users that have role_id meant for admin side
        $users = User::find($usersID);

        // Finds roles that have id meant for admin side
        $roles = Role::find($rolesID);

        return view ('adminlte.admin.team.privileges.roles.assign-role', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleAssignRequest $request
     * @return RedirectResponse
     */
    public function store(RoleAssignRequest $request)
    {
        // Finds user by request member id
        $user = User::find($request->member);

        // Finds role by request role id
        $role = Role::find($request->role);

        // Retrieves all of the values for a given key
        $roleID = $role->pluck('id');

        // Syncs role to member
        $user->syncRoles($roleID);

        return redirect()->back()->with('message', __('Successfully assigned member - ') . $user->name . __(' to role - ') . $request->roleName);
    }
}
