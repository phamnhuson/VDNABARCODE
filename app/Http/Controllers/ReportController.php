<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
	 
    public function index(Request $request)
    {
		
		/*$list_species = DB::table('species')->get();
						
		$arr_species=array();

		$arr_species[''] = 'Chọn loài';
		
		foreach($list_species as $sp)
		{
			$arr_species[$sp['species_id']]=$sp['species_name'];
		}
		
		$viewData['arr_species']=$arr_species;*/
		
		$list_city = DB::table('city')->get();									
		
		$count_city = DB::table('barcode2city')->select(DB::raw(' COUNT(*) as count, city_id'))->groupBy('city_id')->get();
		
		$c_city=array();
		
		foreach($count_city as $cc)
		{
			$c_city[$cc['city_id']]=$cc['count'];
		}
		
		$tk_city=array();
		
		foreach($list_city as $key=>$value)
		{
			if(array_key_exists($value['city_id'],$c_city))
			{
				$tk_city[]=array(
							'city_id'	=>	$value['city_id'],
							'city_name' =>	$value['city_name'],
							'count'		=>	$c_city[$value['city_id']],
				);
			}else{
				$tk_city[]=array(
							'city_id'	=>	$value['city_id'],
							'city_name' =>	$value['city_name'],
							'count'		=>	0,
				);
			}
		};

		$count_account = DB::table('users')->get();
		
		$count_admin=0;
		
		$count_user=0;
		
		foreach($count_account as $ac)
		{
			if($ac['role']==3){
				$count_admin++;
			}
			if($ac['role']==1){
				$count_user++;
			}
		}		
		
		$viewData['total_barcode']=DB::table('barcode')->select(DB::raw('count(*) as count_barcode'))->get();
		
		$viewData['tk_city']=$tk_city;
		
		$viewData['count_phylum']=DB::table('phylum')->select(DB::raw('count(*) as count_phylum'))->get();
		
		$viewData['count_class']=DB::table('class')->select(DB::raw('count(*) as count_class'))->get();
		
		$viewData['count_order']=DB::table('order')->select(DB::raw('count(*) as count_order'))->get();
		
		$viewData['count_family']=DB::table('family')->select(DB::raw('count(*) as count_family'))->get();
		
		$viewData['count_genus']=DB::table('genus')->select(DB::raw('count(*) as count_genus'))->get();
		
		$viewData['count_species']=DB::table('species')->select(DB::raw('count(*) as count_species'))->get();
		
		$viewData['count_account']=count($count_account);
		
		$viewData['count_admin']=$count_admin;
		
		$viewData['count_user']=$count_user;
		
		return view('report')->with('data',$viewData);
	}

}	