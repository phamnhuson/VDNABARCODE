<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListgeneController extends Controller
{

    public function index(Request $request)
    {
		
		$list_gene = DB::table('gene')->where('status','1')->paginate(10);
		
		/*echo "<pre>";
		print_r($list_gene);
		echo "</pre>";
		exit();*/
								
		$viewData['list_gene'] = $list_gene;
		
		return view('listgene')->with('data',$viewData);
	}

}	