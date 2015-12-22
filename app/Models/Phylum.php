<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phylum extends Model
{
    protected $table = 'phylum';
	protected $primaryKey = 'phylum_id';
	
	public function kingdom()
	{
		return $this->belongsTo('App\Models\Kingdom');
	}
	
	public function classes()
	{
		return $this->hasMany('App\Models\Classes', 'phylum_id');
	}
	
}
