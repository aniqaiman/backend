<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	protected $table = 'lorrytype';
	protected $primaryKey = 'type_id';
	public $timestamp = 'true';
	protected $fillable = [
	'type',
	];

	public function driver()
	{
		return $this->hasMany('App\Driver','driver_id');
	}
}
