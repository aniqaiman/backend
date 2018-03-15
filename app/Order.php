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
    	'product_id',
    	'item_quantity',
    	'product_price',
    	'promo_price',
    	];

        public function users()
        {
            return $this->belongsTo('App\User','user_id');
        }

        public function products()
        {
            return $this->belongsTo('App\Product','product_id');
        }

        public function prices()
        {
            return $this->belongsTo('App\Price','product_price');
        }
}
