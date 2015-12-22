<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
	protected $primaryKey = 'order_id';
	
	public function classes()
	{
		return $this->belongsTo('App\Models\Classes', 'class_id');
	}
	
	public function families()
	{
		return $this->hasMany('App\Models\Family', 'order_id');
	}
	
}
