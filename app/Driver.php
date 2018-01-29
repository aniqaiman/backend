<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'name',
    	'ic_number',
    	'home_address',
    	'phone_number',
    	'license_number',
    	'drivers_license',
    	'roadtax_expiry',
    	'type_of_lorry',
    	'lorry_capacity',
    	'location_to_cover',
    	'lorry_plate_number',
    	'bank_name',
    	'bank_acc_holder_name',
    	'bank_acc_number',
    	];
}
