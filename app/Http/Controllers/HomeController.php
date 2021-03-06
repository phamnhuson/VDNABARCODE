<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Auth;
use Session;

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
		
		if(Session::get('user')=='' && Session::get('guest')=='')
		{
			$ss_id = 'G'.rand(1,9999);
			Session::put('guest',$ss_id);			
			DB::table('useronline')->insert(array('user_id'=>$ss_id,'time'=>time()));
		}
		
		$time=time();
		$tgout=7200;
		$tgnew=$time - $tgout;
		
		DB::table('useronline')->where('time','<',$tgnew)->delete();
		
		$count['online']= DB::table('useronline')->count();
		
        return view('pages.home')->with('data',$count);;
    }
}