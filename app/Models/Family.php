<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'family';
	protected $primaryKey = 'family_id';
	
	public function order()
	{
		return $this->belongsTo('App\Models\Order');
	}
	
	public function genus()
	{
		return $this->hasMany('App\Models\Genus', 'family_id');
	}
	
}
