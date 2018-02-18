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
    	'category',
    	];

    public function prices()
    {
    	return $this->hasMany('App\Price','product_id');
    }

    public function categories()
    {
    	return $this->belongsTo('App\Category', 'product_id');
    }
}
