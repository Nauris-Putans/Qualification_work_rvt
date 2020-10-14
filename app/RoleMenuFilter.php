<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class RoleMenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['role']) && ! Auth::user()->hasRole($item['role'])) {
            return false;
        }

        return $item;
    }
}
