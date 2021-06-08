<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Models\Adminlte\admin\team\UserAdmin;
use App\Http\Controllers\Controller;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Finds roles that are meant for user side
        $roles = DB::table('role_user')
            ->where('role_id', '<=' , 3)
            ->get();

        // Retrieves all of the values for a given key
        $roles = $roles->pluck('user_id');

        // Finds users that have role_id meant for user side
        $users = User::find($roles);

        return view('adminlte.admin.users', compact('users', 'hashids'));
    }
}
