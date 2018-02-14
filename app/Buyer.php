<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = 'buyers';
    protected $primaryKey = 'buyer_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'owner_name',
    	'company_name',
    	'company_reg_ic_number',
    	'company_address',
    	'phone_number',
    	'handphone_number',
    	'email_address',
    	'password',
    	];
}
