<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'lorry_id',
        'feedback_topic',
        'feedback_description',
        'feedback_response',
        'feedback_read',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function inventories()
    {
        return $this->belongsToMany('App\Inventory');
    }

    public function promotions()
    {
        return $this->belongsToMany('App\Inventory');
    }

    public function driver()
    {
        return $this->belongsTo('App\User', 'lorry_id');
    }

    public function products()
    {
        return $this
            ->belongsToMany('App\Product')
            ->withPivot(
                'grade',
                'quantity'
            );
    }

    public function totalPrice()
    {
        return $this->products()
            ->get()
            ->sum(function ($product) {
                if ($product->pivot->grade === "A") {
                    return $product->priceLatest()["buyer_price_a"] * $product->pivot->quantity;
                } else if ($product->pivot->grade === "B") {
                    return $product->priceLatest()["buyer_price_b"] * $product->pivot->quantity;
                }
            });
    }

    public function totalQuantity()
    {
        return $this->products()
            ->get()
            ->sum('pivot.quantity');
    }
}
