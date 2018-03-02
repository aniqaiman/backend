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
    	'price_id',
    	'product_image',
    	'category',
    	];

    public function prices()
    {
    	return $this->hasMany('App\Price','price_id');
    }

    public function categories()
    {
    	return $this->belongsTo('App\Category', 'product_id');
    }

    public function orders()
    {
        return $this->belongsTo('App\Order','product_id');
    }
}
