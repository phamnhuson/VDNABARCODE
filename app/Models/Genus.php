<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    protected $table = 'genus';
	protected $primaryKey = 'genus_id';
	
	public function family()
	{
		return $this->belongsTo('App\Models\Family');
	}
	
	public function species()
	{
		return $this->hasMany('App\Models\Specie', 'genus_id');
	}
	
}
