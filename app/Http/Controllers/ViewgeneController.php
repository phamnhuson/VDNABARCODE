<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;

class ViewgeneController extends Controller {
	
	public function index(Request $request)
	{	
	
		$geneId = $request->get('id');
							
		$gene = DB::table('gene')->where('sequence_id', $geneId)->get();
		
		$viewData['gene'] = $gene;
		
		return view('viewgene')->with('data',$viewData);
		
	}
	
}
