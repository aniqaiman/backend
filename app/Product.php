<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'product_name',
    	'product_desc',
    	'product_price',
    	'product_image',
    	];

    public function prices()
    {
    	return $this->hasMany('App\Price','product_id');
    }
}
