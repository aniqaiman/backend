<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'product_id',
    	'product_quantity',
    	'product_grade',
    	'user_id',
    	];

    	public function sellers()
    	{
    		return $this->belongsTo('App\User','user_id');
    	}

    	public function products()
    	{
    		return $this->belongsTo('App\Product','product_id');
    	}
}
