<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = [
        'total_price',
    ];

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this
            ->belongsToMany('App\Product')
            ->withPivot('quantity');
    }

    public function getProductsAttribute()
    {
        return $this->products()->get();
    }

    public function getTotalPriceAttribute()
    {
        return $this->products()
            ->get()
            ->sum(function ($product) {
                return $product->priceLatest()->price_a * $product->pivot->quantity;
            });
    }

    public function getTotalQuantityAttribute()
    {
        return $this->products()
            ->get()
            ->sum('pivot.quantity');
    }
}
