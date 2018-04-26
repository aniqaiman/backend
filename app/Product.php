<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function priceLatest()
    {
        return $this->validPrices()
            ->first();
    }

    public function pricePrevious()
    {
        return $this->validPrices()
            ->skip(1)
            ->first();
    }

    public function priceDifference()
    {
        return (object) [
            "price_a" => is_null($this->pricePrevious()) ? 0 : round(($this->priceLatest()->price_a - $this->pricePrevious()->price_a) / $this->pricePrevious()->price_a, 2),
            "price_b" => is_null($this->pricePrevious()) ? 0 : round(($this->priceLatest()->price_b - $this->pricePrevious()->price_b) / $this->pricePrevious()->price_b, 2),
            "price_c" => is_null($this->pricePrevious()) ? 0 : round(($this->priceLatest()->price_c - $this->pricePrevious()->price_c) / $this->pricePrevious()->price_c, 2),
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
