<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{

	 
    public function index(Request $request)
    {
		
		$list_family = DB::table('kingdom')
								->join('phylum','kingdom.kingdom_id','=','phylum.kingdom_id')
								->join('class','phylum.phylum_id','=','class.phylum_id')
								->join('order','class.class_id','=','order.class_id')
								->join('family','order.order_id','=','family.order_id')
								->select('kingdom.kingdom_id','family.family_id','family.family_name')
								->get();
								
		$list_kingdom = DB::table('kingdom')->get();
		
		$viewData['list_family'] = $list_family;
		
		$viewData['list_kingdom'] = $list_kingdom;
		
		return view('list')->with('data',$viewData);
	}

}	