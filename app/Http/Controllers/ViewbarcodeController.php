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
					
		$viewData['barcode'] = $barcode;
		
		$viewData['file_img'] = $file_img;

		return view('viewbarcode')->with('data',$viewData);
		
	}
	
}
