<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    public $timestamp = 'true';
    protected $fillable = [
    	'group_name',
    	];

    public function users()
    {
    	return $this->belongsTo('App\User','group_id');
    }
}
