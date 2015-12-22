<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $table = 'species';
	protected $primaryKey = 'species_id';
	
	public function genus()
	{
		return $this->belongsTo('App\Models\Genus');
	}
	
	public function barcodes()
	{
		return $this->hasOne('App\Models\Specie', 'species_id');
	}
}
