<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = [
        'latest_price',
        'price_difference',
        'category',
    ];
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'image',
        'category_id',
        'quantity_a',
        'quantity_b',
        'quantity_c',
        'demand_a',
        'demand_b',
        'demand_c',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getCategoryAttribute()
    {
        return $this->category()->get();
    }

    public function orders()
    {
        return $this
            ->belongsToMany('App\Order')
            ->withPivot('quantity');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }

    public function validPrices()
    {
        return $this->prices()
            ->whereDate("date_price", "<=", Carbon::now())
            ->orderBy("date_price", "desc");
    }

    public function getLatestPriceAttribute()
    {
        return $this->validPrices()
            ->first();
    }

    public function getPreviousPriceAttribute()
    {
        return $this->validPrices()
            ->skip(1)
            ->first();
    }

    public function getPriceDifferenceAttribute()
    {
        return (object) [
            "price_a" => is_null($this->previous_price) ? 0 : round(($this->latest_price->price_a - $this->previous_price->price_a) / $this->previous_price->price_a, 2),
            "price_b" => is_null($this->previous_price) ? 0 : round(($this->latest_price->price_b - $this->previous_price->price_b) / $this->previous_price->price_b, 2),
            "price_c" => is_null($this->previous_price) ? 0 : round(($this->latest_price->price_c - $this->previous_price->price_c) / $this->previous_price->price_c, 2),
        ];
    }

    public function carts()
    {
        return $this
            ->belongsToMany('App\User')
            ->withPivot('quantity');
    }

    public function stocks()
    {
        return $this
            ->belongsToMany('App\Stock')
            ->withPivot('grade', 'quantity');
    }
}
