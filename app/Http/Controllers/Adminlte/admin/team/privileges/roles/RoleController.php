<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\roles;

use App\Http\Requests\RoleAddRequest;
use App\Permission;
use \App\Role;
use App\Http\Controllers\Controller;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        $roles = Role::all();

        return view('adminlte.admin.team.privileges.roles.list', compact( 'roles', 'hashids'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('adminlte.admin.team.privileges.roles.add-role', compact( 'permissions'));
    }

    /**
     * @param RoleAddRequest $request
     * @return RedirectResponse
     */
    public function store(RoleAddRequest $request)
    {
        // Creates new role and stores it in database
        $role = Role::create([
            'name' => $request->roleName,
            'display_name' => $request->roleDisplayName,
            'description' => $request->roleDesc,
        ]);

        // Adds selected permissions to role
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back()->with('message', __('Role - ') .$request->roleName. __(' has been added!'));
    }

    public function update(Request $request)
    {

    }

    public function destroy($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        $role = Role::find($id)->first();

        $role->delete();

        return redirect()->back()->with('message', __('Role - ') . $role->name . __(' has been deleted!'));
    }
}
