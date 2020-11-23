<?php

namespace App\Models\Adminlte\admin;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['fullname', 'email', 'message'];
}
