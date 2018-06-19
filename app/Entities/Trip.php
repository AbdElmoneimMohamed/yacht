<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Entities\Role as RoleEntity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class Trip extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const STATUS_OLD = 1;
    const STATUS_NEW = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boat_id',
        "tripId",
        "distance",
        "creationDate",
        "timeBegin",
        "timeEnd",
        "startLat",
        "startLon",
        "liters",
        "price",
        "currency",
        'notified'
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

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
