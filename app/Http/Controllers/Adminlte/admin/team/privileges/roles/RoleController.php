<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\roles;

use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleEditRequest;
use App\Permission;
use \App\Role;
use App\Http\Controllers\Controller;
use Hashids\Hashids;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Finds all roles
        $roles = Role::all();

        return view('adminlte.admin.team.privileges.roles.list', compact( 'roles', 'hashids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        // Finds all permissions
        $permissions = Permission::all();

        return view('adminlte.admin.team.privileges.roles.add-role', compact( 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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

        // Finds permissionID by user id
        $permissionsID = DB::table('permission_role')
            ->where('role_id', $id)
            ->get();

        // Retrieves all of the values for a given key
        $permissionsID = $permissionsID->pluck('permission_id');

        // Finds permissions by permission id
        $permissions = Permission::find($permissionsID);

        return view('adminlte.admin.team.privileges.roles.edit-role', compact( 'role', 'permissions', 'hashids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(RoleEditRequest $request,$id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds role by user id
        $role = Role::find($id)
            ->first();

        // Inputed values inserts in role values
        $role->name = $request->roleName;
        $role->display_name = $request->roleDisplayName;
        $role->description = $request->roleDesc;

        // Saves inserted values
        $role->save();


        return redirect()->back()->with('message', __('Role - ') . $role->name . __(' has been edited!'));
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

        // Finds role by user id
        $role = Role::find($id)->first();

        // Deletes role
        $role->delete();

        return redirect()->back()->with('message', __('Role - ') . $role->name . __(' has been deleted!'));
    }
}
