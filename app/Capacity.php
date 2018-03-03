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

	public function users()
	{
		return $this->belongsTo('App\User','lorry_capacity');
	}
}
