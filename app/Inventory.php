<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'grade',
        'price_id',
        'remark',
        'wastage',
        'promotion',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function price()
    {
        return $this->belongsTo('App\Price');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function stocks()
    {
        return $this->belongsToMany('App\Stock');
    }
}
