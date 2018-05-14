<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
    	'product_id',
        'seller_price_a',
        'seller_price_b',
        'buying_price_a',
        'buying_price_b',
    	'date_price',
    	];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
