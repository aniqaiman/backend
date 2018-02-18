<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
	protected $table = 'lorrycapacity';
	protected $primaryKey = 'cap_id';
	public $timestamp = 'true';
	protected $fillable = [
	'capacity',
	];

	public function driver()
	{
		return $this->hasMany('App\Driver','driver_id');
	}
}
