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
    	'quantity',
    	'grade_id',
    	'user_id',
    	];
}
