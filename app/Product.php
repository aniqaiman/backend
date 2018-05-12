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
        'demand_a',
        'demand_b',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function carts()
    {
        return $this
            ->belongsToMany('App\User')
            ->withPivot(
                'grade',
                'quantity'
            );
    }

    public function orders()
    {
        return $this
            ->belongsToMany('App\Order')
            ->withPivot(
                'grade',
                'quantity'
            );
    }

    public function stocks()
    {
        return $this
            ->belongsToMany('App\Stock')
            ->withPivot(
                'grade',
                'quantity'
            );
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }

    public function validPrices($order_date)
    {
        return $this->prices()
            ->whereDate('date_price', '<=', $order_date)
            ->orderBy('date_price', 'desc');
    }

    public function priceValid($order_date)
    {
        return $this->validPrices($order_date)
            ->first();
    }

    public function priceLatest()
    {
        return $this->validPrices(Carbon::now())
            ->first();
    }

    public function pricePrevious()
    {
        return $this->validPrices(Carbon::now())
            ->skip(1)
            ->first();
    }

    public function priceDifference()
    {
        return (object) [
            'selling_price_a' => is_null($this->pricePrevious()) || $this->pricePrevious()["selling_price_a"] == 0  ? 0 : round(($this->priceLatest()["selling_price_a"] - $this->pricePrevious()["selling_price_a"]) / $this->pricePrevious()["selling_price_a"], 2),
            'selling_price_b' => is_null($this->pricePrevious()) || $this->pricePrevious()["selling_price_b"] == 0 ? 0 : round(($this->priceLatest()["selling_price_b"] - $this->pricePrevious()["selling_price_b"]) / $this->pricePrevious()["selling_price_b"], 2),
            'buying_price_a' => is_null($this->pricePrevious()) || $this->pricePrevious()["buying_price_a"] == 0  ? 0 : round(($this->priceLatest()["buying_price_a"] - $this->pricePrevious()["buying_price_a"]) / $this->pricePrevious()["buying_price_a"], 2),
            'buying_price_b' => is_null($this->pricePrevious()) || $this->pricePrevious()["buying_price_b"] == 0 ? 0 : round(($this->priceLatest()["buying_price_b"] - $this->pricePrevious()["buying_price_b"]) / $this->pricePrevious()["buying_price_b"], 2),
        ];
    }

}
