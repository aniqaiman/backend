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
                return $product->latest_price->price_a * $product->pivot->quantity;
            });
    }

    public function buyer()
    {
        return $this->belongsTo('App\User');
    }
}
