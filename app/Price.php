<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
    	'product_id',
        'price_a',
        'price_b',
    	'price_c',
    	'date_price',
    	];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
