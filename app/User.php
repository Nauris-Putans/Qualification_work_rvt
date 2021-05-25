<?php

namespace App;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'phone_number', 'country', 'city', 'gender', 'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gets user information with roles table information
     *
     * @return $this
     */
    public function getUser()
    {
        $this->load('roles');
        return $this;
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'foreign_key', 'local_key');
    }
}
