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
		$user = Session::get('user');
		
		$speciesId = $request->get('id');
		
		$user = Session::get('user');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($speciesId);
		}
		
		/*if($action=='accept')
		{
			return $this->accept($speciesId);
		}*/
		
		if($user['role']==3){
			$list_barcode = DB::table('barcode')
								->join('species','barcode.species','=','species.species_id')								
								->paginate(20);
		}else{
			$list_barcode = DB::table('barcode')
								->join('species','barcode.species','=','species.species_id')
								->where('created_by',$user['id'])->paginate(20);
		}

		$viewData['list_barcode']=$list_barcode;
		$viewData['role']=$user['role'];
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
	
	function accept(Request $request)
	{
		$barcodeId=$request->get('id');
		$update=array();
		$update['status']=1;
		if(DB::table('barcode')->where('barcode_id', $barcodeId)->update($update)){
			return \Redirect('barcode')->with('responseData', array('statusCode' => 1, 'message' => 'Đã duyệt thành công'));	
		}else{
			return \Redirect('barcode')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa duyệt được, vui lòng thử lại'));
		}
	}
}
