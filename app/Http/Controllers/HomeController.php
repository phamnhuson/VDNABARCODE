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
		$count['species']=DB::table('species')->count();
        return view('pages.home')->with('data',$count);;
    }
}