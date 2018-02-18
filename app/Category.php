<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'cat_id';
	public $timestamp = 'true';
	protected $fillable = [
	'cat_name',
	];

	public function products()
	{
		return $this->hasMany('App\Product', 'cat_id');
	}
}
