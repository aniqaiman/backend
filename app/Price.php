<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
    	'product_id',
        'price_a',
        'price_b',
    	'date_price',
    	];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
