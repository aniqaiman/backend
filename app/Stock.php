<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function seller()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this
            ->belongsToMany('App\Product')
            ->withPivot('grade', 'quantity');
    }
}
