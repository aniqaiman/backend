<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $hidden = ['password', 'remember_token'];
    public $timestamp = 'true';
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
    	];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
