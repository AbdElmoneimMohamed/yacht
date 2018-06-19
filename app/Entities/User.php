<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Entities\Role as RoleEntity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone',
        'imageUrl','password', 'status', "avatar",
        "address","activationCode", "activated", "forget_token", 'fb_token','deviceType'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function boats()
    {
        return $this->hasMany(Boat::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function trips()
    {
        return $this->hasManyThrough(Trip::class, Boat::class, "user_id", "boat_id");
    }
}
