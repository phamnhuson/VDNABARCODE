<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;

class ViewbarcodeController extends Controller {
	
	public function index(Request $request)
	{	
	
		$barcodeId = $request->get('id');
							
		$barcode = DB::table('barcode')
							->join('species','species.species_id','=','barcode.species')
							->join('genus','species.genus_id','=','genus.genus_id')
							->join('family','genus.family_id','=','family.family_id')
							->join('order','family.order_id','=','order.order_id')
							->join('class','order.class_id','=','class.class_id')
							->join('phylum','class.phylum_id','=','phylum.phylum_id')
							->join('kingdom','phylum.kingdom_id','=','kingdom.kingdom_id')
							->join('users','users.id','=','barcode.created_by')
							->where('barcode.barcode_id', $barcodeId)->get();
		
		$file_img = DB::table('file_img')->where('file_img.barcode_id',$barcodeId)->get();
		
		$file_trace = DB::table('file_trace')->Where('file_trace.barcode_id',$barcodeId)->get();
		
		$location = DB::table('location')->Where('location.barcode_id',$barcodeId)->get();
		
		$loca=array();
		
		if($location!=null)
		{
			foreach($location as $key=>$lc)
			{
				$loca[$key][]='';
				$loca[$key][]=$lc['latitude'];
				$loca[$key][]=$lc['longitude'];
			}
		}

		$viewData['loca'] = json_encode($loca);	
		
		$viewData['location'] = $location;												
		
		$viewData['file_trace'] = $file_trace;
					
		$viewData['barcode'] = $barcode[0];
		
		$viewData['file_img'] = $file_img;
		
		/*echo "<pre>";
		print_r($viewData);
		echo "</pre>";
		exit();*/
		
		return view('viewbarcode')->with('data',$viewData);
		
	}
	
}
