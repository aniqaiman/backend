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

    public function totalPurchased($product_id, $grade)
    {
        return $this
            ->stocks
            ->map(function ($stock, $key) use ($product_id, $grade) {
                return $stock
                ->getQuantityByProduct($product_id, $grade);
            })
            ->sum();
    }

    public function totalSold($product_id, $grade)
    {
        return $this
            ->orders
            ->map(function ($order, $key) use ($product_id, $grade) {
                return $order
                ->getQuantityByProduct($product_id, $grade);
            })
            ->sum();
    }
}
