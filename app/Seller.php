<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
    protected $primaryKey = 'seller_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'owner_name',
    	'company_name',
    	'registration_number',
    	'ic_number',
    	'farm_address',
    	'handphone_number',
    	'email_address',
    	'password',
    	];
}
