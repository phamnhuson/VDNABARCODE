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

		$count['gene']=DB::table('gene')->where('status','1')->count();
		
		$count['publication']=DB::table('news')->where('category','0')->where('status','1')->count();
								
		$count['news']=DB::table('news')->where('category','1')->orderBy('new_id', 'desc')->limit(5)->get();
		
		$count['visitors'] = DB::table('configs')->where('name', 'number_visitor')->get();
		
		$count['users'] = DB::table('users')->count();
		
		$count['genome'] = DB::table('genome')->count();				
		
		$arr_link=array();
		
		$count['list_link']=DB::table('link')->get();

		foreach($count['list_link'] as $fm)
		{
			$arr_link[$fm['link_id']]=$fm['link_name'];
		}
		
		$count['arr_link']=$arr_link;
		
        return view('pages.home')->with('data',$count);;
    }
}