<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = ['fullname', 'email', 'message'];
}
