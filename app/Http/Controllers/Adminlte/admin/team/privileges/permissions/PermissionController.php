<?php

namespace App\Http\Controllers\Adminlte\admin\team\privileges\permissions;

use App\Http\Requests\PermissionAddRequest;
use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.admin.team.privileges.permissions.add-permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionAddRequest $request
     * @return RedirectResponse
     */
    public function store(PermissionAddRequest $request)
    {
        // Creates new permisson and stores it in database
        Permission::create([
            'name' => $request->permissionName,
            'display_name' => $request->permissionDisplayName,
            'description' => $request->permissionDesc,
        ]);

        return redirect()->back()->with('message', 'Permission - '.$request->permissionName.' has been added!');
    }
}
