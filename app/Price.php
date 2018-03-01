<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';
    protected $primaryKey = 'price_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'product_id',
        'product_price',
        'product_price2',
    	'product_price3',
    	'date_price',
    	];

    public function products()
    {
    	return $this->belongsTo('App\Product','product_id');
    }
}
