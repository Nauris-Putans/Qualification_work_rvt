<?php

namespace App\Http\Controllers\Adminlte\admin;

use \App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.admin.add-role');
    }

    public function store(Request $request)
    {
        Role::create([
            'name' => $request->roleName,
            'display_name' => $request->roleDisplayName,
            'description' => $request->roleDesc,
        ]);

        return redirect()->back()->with('message', 'Role has been added!');
    }
}