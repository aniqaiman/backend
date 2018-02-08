<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';
    protected $primaryKey = 'price_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'vegetable_id',
    	'fruit_id',
    	'product_price',
    	'date_price',
    	];
}
