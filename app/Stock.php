<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
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
            ->withPivot('grade', 'quantity');
    }

    public function totalPrice()
    {
        return $this->products()
            ->get()
            ->sum(function ($product) {
                return $product->priceLatest()->price_a * $product->pivot->quantity;
            });
    }

    public function totalQuantity()
    {
        return $this->products()
            ->get()
            ->sum('pivot.quantity');
    }
}
