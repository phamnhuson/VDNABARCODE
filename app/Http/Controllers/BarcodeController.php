<?php namespace App\Http\Controllers;

use DB;
use Validator; 
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Repositories\Fastas\NucleotideRepository;

class BarcodeController extends Controller {
	
	public function index(Request $request)
	{	

		$speciesId = $request->get('id');
		
		$user = Session::get('user');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($speciesId);
		}

		$list_barcode = DB::table('barcode')->where('created_by',$user['id'])->paginate(20);
		
		$viewData['list_barcode']=$list_barcode;		
		return view('barcode')->with('data',$viewData);

	}
	
	function delete($barcodeId)
	{
		if (DB::table('barcode')->where('barcode_id', $barcodeId)->delete()) {
			
			DB::table('file_img')->where('barcode_id', $barcodeId)->delete();
			
			DB::table('file_trace')->where('barcode_id', $barcodeId)->delete();
			
			$nuRepo = new NucleotideRepository;
			$nuRepo->delete(array('id' => $barcodeId));
			
			return \Redirect('barcode')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));		
						
			
		} else {
		
			return \Redirect('barcode')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}	

}
