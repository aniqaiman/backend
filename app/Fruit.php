<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruits';
    protected $primaryKey = 'fruit_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'fruit_name',
    	'fruit_desc',
    	'fruit_price',
    	'fruit_image',
    	];
}
