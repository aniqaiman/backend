<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $primaryKey = 'state_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'state_name',
    	];
}
