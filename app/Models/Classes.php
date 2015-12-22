<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';
	protected $primaryKey = 'class_id';
	
	public function phylum()
	{
		return $this->belongsTo('App\Models\Phylum');
	}
	
	public function orders()
	{
		return $this->hasMany('App\Models\Order', 'class_id');
	}
	
}
