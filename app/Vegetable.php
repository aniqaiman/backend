<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    protected $table = 'vegetables';
    protected $primaryKey = 'vegetable_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'vegetable_name',
    	'vegetable_desc',
    	'vegetable_price',
    	'vegetable_image',
    	];
}
