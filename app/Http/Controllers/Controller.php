<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
	
	function __construct()
	{
		\DB::table('configs')->where('name', 'number_visitor')->update(array('value' => \DB::raw('value+1')));
	}
	
}
