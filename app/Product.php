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

    public function supplies()
    {
        return $this->belongsToMany('App\User', 'supplies')
            ->withPivot(
                'harvesting_period_start',
                'harvesting_period_end',
                'harvest_frequency',
                'total_plants',
                'total_farm_area'
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

    public function pricesValid($order_date)
    {
        return $this->prices()
            ->whereDate('date_price', '<=', $order_date)
            ->orderBy('date_price', 'desc');
    }

    public function priceValid($order_date)
    {
        return $this->pricesValid($order_date)
            ->first();
    }

    public function priceLatest()
    {
        return $this->pricesValid(Carbon::now())
            ->first();
    }

    public function pricePrevious()
    {
        return $this->pricesValid(Carbon::now())
            ->skip(1)
            ->first();
    }

    public function priceToday()
    {
        return $this->prices()
            ->whereDate('date_price', '=', Carbon::today())
            ->first();
    }

    public function priceYesterday()
    {
        return $this->prices()
            ->whereDate('date_price', '=', Carbon::yesterday())
            ->first();
    }

    public function priceDifference()
    {
        return (object) [
            'seller_price_a' => is_null($this->pricePrevious()) || $this->pricePrevious()["seller_price_a"] == 0 ? 0 : round(($this->priceLatest()["seller_price_a"] - $this->pricePrevious()["seller_price_a"]) / $this->pricePrevious()["seller_price_a"], 2),
            'seller_price_b' => is_null($this->pricePrevious()) || $this->pricePrevious()["seller_price_b"] == 0 ? 0 : round(($this->priceLatest()["seller_price_b"] - $this->pricePrevious()["seller_price_b"]) / $this->pricePrevious()["seller_price_b"], 2),
            'buyer_price_a' => is_null($this->pricePrevious()) || $this->pricePrevious()["buyer_price_a"] == 0 ? 0 : round(($this->priceLatest()["buyer_price_a"] - $this->pricePrevious()["buyer_price_a"]) / $this->pricePrevious()["buyer_price_a"], 2),
            'buyer_price_b' => is_null($this->pricePrevious()) || $this->pricePrevious()["buyer_price_b"] == 0 ? 0 : round(($this->priceLatest()["buyer_price_b"] - $this->pricePrevious()["buyer_price_b"]) / $this->pricePrevious()["buyer_price_b"], 2),
        ];
    }

    public function priceTodayYesterdayDifference()
    {
        return (object) [
            'seller_price_a' => is_null($this->priceToday()) || is_null($this->priceYesterday()) || $this->priceYesterday()["seller_price_a"] == 0 ? 0 : round(($this->priceToday()["seller_price_a"] - $this->priceYesterday()["seller_price_a"]) / $this->priceYesterday()["seller_price_a"], 2),
            'seller_price_b' => is_null($this->priceToday()) || $this->priceYesterday()["seller_price_b"] == 0 ? 0 : round(($this->priceToday()["seller_price_b"] - $this->priceYesterday()["seller_price_b"]) / $this->priceYesterday()["seller_price_b"], 2),
            'buyer_price_a' => is_null($this->priceToday()) || $this->priceYesterday()["buyer_price_a"] == 0 ? 0 : round(($this->priceToday()["buyer_price_a"] - $this->priceYesterday()["buyer_price_a"]) / $this->priceYesterday()["buyer_price_a"], 2),
            'buyer_price_b' => is_null($this->priceToday()) || $this->priceYesterday()["buyer_price_b"] == 0 ? 0 : round(($this->priceToday()["buyer_price_b"] - $this->priceYesterday()["buyer_price_b"]) / $this->priceYesterday()["buyer_price_b"], 2),
        ];
    }

    public function full($category)
    {
        return $this
            ->with("category")
            ->where("category_id", $category)
            ->get()
            ->each(function ($product) {
                $product['price_latest'] = $product->priceLatest();
                $product['price_difference'] = $product->priceDifference();
            });
    }

    public function promotions()
    {
        return $this->hasMany('App\Promotion');
    }

}
