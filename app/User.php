<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $hidden = ['password', 'remember_token'];
    public $timestamp = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'buss_hour',
        'address',
        'phonenumber',
        'profilepic',
        'remember_token',
        'company_name',
        'company_reg_ic_number',
        'handphone_number',
        'bank_name',
        'bank_acc_holder_name',
        'bank_acc_number',
        'latitude',
        'longitude',
        'group_id',
        'license_number',
        'drivers_license',
        'roadtax_expiry',
        'type_of_lorry',
        'lorry_capacity',
        'location_to_cover',
        'lorry_plate_number',
    ];

    public function groups()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function orders()
    {
        return $this->belongsTo('App\Order', 'user_id');
    }

    public function types()
    {
        return $this->belongsTo('App\Type', 'type_of_lorry');
    }

    public function capacities()
    {
        return $this->belongsTo('App\Capacity', 'lorry_capacity');
    }

    // public function stocks()
    // {
    //     return $this->belongsTo('App\Stock','user_id');
    // }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
