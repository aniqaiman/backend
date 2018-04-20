<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'image',
        'category_id',
        'quantityA',
        'quantityB',
        'quantityC',
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
