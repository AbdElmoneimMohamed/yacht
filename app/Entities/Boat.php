<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class Boat extends Authenticatable
{
    use  Notifiable, SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "boatId", "name", "type", "brand", "totalRpm", "tankSize", "fuelQuentity", "sizeByFeet", "registerationDate", "registerationTime","user_id","numberOfGenerators", "numberOfPersons"
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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function engines()
    {
        return $this->hasMany(Engine::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function rpms()
    {
        return $this->hasMany(Rpm::class);
    }
}
