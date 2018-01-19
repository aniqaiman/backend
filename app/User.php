<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'address',
    	'phonenumber',
    	'profilepic',
    	];
}
