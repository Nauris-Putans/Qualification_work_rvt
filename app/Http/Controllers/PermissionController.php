<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.admin.add-permission');
    }

    public function store(Request $request)
    {
        Permission::create([
            'name' => $request->permissionName,
            'display_name' => $request->permissionDisplayName,
            'description' => $request->permissionDesc,
        ]);

        return redirect()->back()->with('message', 'Permission has been added!');
    }
}
