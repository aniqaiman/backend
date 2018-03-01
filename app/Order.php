<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'user_id',
    	'item_id',
    	'item_quantity',
    	'product_price',
    	'promo_price',
    	];
}
