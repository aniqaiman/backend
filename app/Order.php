<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
            ->withPivot(
                'grade',
                'quantity',
                'feedback_topic',
                'feedback_description',
                'feedback_response',
                'feedback_read'
            );
    }

    public function totalPrice()
    {
        return $this->products()
            ->get()
            ->sum(function ($product) {
                if ($product->pivot->grade === "A") {
                    return $product->priceLatest()->price_a * $product->pivot->quantity;
                }
                else if ($product->pivot->grade === "B") {
                    return $product->priceLatest()->price_b * $product->pivot->quantity;
                }
                else if ($product->pivot->grade === "C") {
                    return $product->priceLatest()->price_c * $product->pivot->quantity;
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
