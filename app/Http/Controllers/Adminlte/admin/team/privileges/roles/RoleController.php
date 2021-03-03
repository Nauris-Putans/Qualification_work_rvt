<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\roles;

use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleEditRequest;
use App\Permission;
use \App\Role;
use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Finds all roles
        $roles = Role::all();

        return view('adminlte.admin.team.privileges.roles.list', compact('roles', 'hashids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        // Finds all permissions
        $permissions = Permission::all();

        return view('adminlte.admin.team.privileges.roles.add-role', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleAddRequest $request
     * @return RedirectResponse
     */
    public function store(RoleAddRequest $request)
    {
        // Data from request
        $data = [
            'name' => $request->roleName,
            'display_name' => $request->roleDisplayName,
            'description' => $request->roleDesc,
        ];

        // Creates new role and stores it in database
        $role = Role::create($data);

        // Adds selected permissions to role
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back()->with('message', __("Role ':role' - :action", ['role' => $request->roleName, 'action' => __("has been added!")]));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds role by user id
        $role = Role::find($id)
            ->first();

        // Finds permissions by permission id
        $permissions = Permission::all();

        return view('adminlte.admin.team.privileges.roles.view-role', compact('role', 'hashids', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds role by user id
        $role = Role::find($id)
            ->first();

        // Finds permissions by permission id
        $permissions = Permission::all();

        return view('adminlte.admin.team.privileges.roles.edit-role', compact('role', 'permissions', 'hashids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RoleEditRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds role by user id
        $role = Role::find($id)
            ->first();

        // Data from request
        $data = [
            'name' => $request->roleName,
            'display_name' => $request->roleDisplayName,
            'description' => $request->roleDesc,
        ];

        // Updates values
        $role->update($data);

        // Syncs permission to role
        $role->syncPermissions($request->get('permissions') ?? []);

        return redirect()->back()->with('message', __("Role ':role' - :action", ['role' => $role->name, 'action' => __("has been edited!")]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds default role
        $defaultRole = Role::find(5);

        // Finds role by user id
        $role = Role::find($id)->first();

        // Finds userRoles with $role->id
        $userRoles = DB::table('role_user')
            ->where('role_id', $role->id)
            ->get();

        // Retrieves all of the values for a given key
        $userRoles = $userRoles->pluck('user_id');

        // Finds users by $userRoles
        $users = User::find($userRoles);

        // Syncs default roles for each user that had deleted role
        foreach ($users as $user)
        {
            $user->syncRoles([$defaultRole->id]);
        }

        // Deletes role
        $role->delete();

        return redirect()->back()->with('message', __("Role ':role' - :action", ['role' => $role->name, 'action' => __("has been deleted!")]));
    }
}
