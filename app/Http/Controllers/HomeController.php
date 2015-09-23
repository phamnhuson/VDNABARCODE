<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()	
    {
		$count=array();
		$count['barcode']=DB::table('barcode')->where('status','1')->count();
		$count['plantae']=DB::table('kingdom')
								->join('phylum','phylum.kingdom_id','=','kingdom.kingdom_id')
								->join('class','class.phylum_id','=','phylum.phylum_id')
								->join('order','order.class_id','=','class.class_id')
								->join('family','family.order_id','=','order.order_id')
								->join('genus','genus.family_id','=','family.family_id')
								->join('species','species.genus_id','=','genus.genus_id')
								->where('kingdom.kingdom_id','1')
								->count();
								
		$count['Animalia']=DB::table('kingdom')
								->join('phylum','phylum.kingdom_id','=','kingdom.kingdom_id')
								->join('class','class.phylum_id','=','phylum.phylum_id')
								->join('order','order.class_id','=','class.class_id')
								->join('family','family.order_id','=','order.order_id')
								->join('genus','genus.family_id','=','family.family_id')
								->join('species','species.genus_id','=','genus.genus_id')
								->where('kingdom.kingdom_id','3')
								->count();
        return view('pages.home')->with('data',$count);;
    }
}