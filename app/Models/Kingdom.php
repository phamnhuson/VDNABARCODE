<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kingdom extends Model
{
    protected $table = 'kingdom';
	protected $primaryKey = 'kingdom_id';
	
	public function phylums()
	{
		return $this->hasMany('App\Models\Phylum', 'kingdom_id');
	}
	
}
