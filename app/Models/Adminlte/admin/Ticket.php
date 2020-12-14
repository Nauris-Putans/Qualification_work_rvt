<?php

namespace App\Models\Adminlte\admin;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title', 'type', 'fullname', 'email', 'message', 'action', 'status', 'user_id'];
}
