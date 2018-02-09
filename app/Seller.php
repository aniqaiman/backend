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
        'latitude',
        'longitude',
    	'handphone_number',
    	'email_address',
    	'password',
        'group_id',
        'bank_name',
        'bank_acc_holder_name',
        'bank_holder_number',
    	];
}
