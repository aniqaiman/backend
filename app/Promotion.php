<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'product_id',
        'stock_id',
        'wastage',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }


}
