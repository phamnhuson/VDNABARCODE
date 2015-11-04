<?php namespace App\Http\Controllers;

use DB;
use Validator; 
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Repositories\Fastas\NucleotideRepository;

class GeneController extends Controller {
	
	public function index(Request $request)
	{	
		$user = Session::get('user');
		
		$sequence_id = $request->get('id');
		
		$user = Session::get('user');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($sequence_id);
		}
		
		if($action=='accept')
		{
			return $this->accept($sequence_id);
		}
		
		if($user['role']==3){
			$list_gene = DB::table('gene')->paginate(20);
		}else{
			$list_gene = DB::table('gene')->where('created_by',$user['id'])->paginate(20);
		}

		$viewData['list_gene']=$list_gene;
		$viewData['role']=$user['role'];
		return view('gene')->with('data',$viewData);

	}
	
	function delete($geneId)
	{
		if (DB::table('gene')->where('sequence_id', $geneId)->delete()) {		

			return \Redirect('gene')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));		

		} else {
		
			return \Redirect('gene')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}	
	
	function accept($geneId)
	{
		$update=array();
		$update['status']=1;
		if(DB::table('gene')->where('sequence_id', $geneId)->update($update)){				
			return \Redirect('gene')->with('responseData', array('statusCode' => 1, 'message' => 'Đã duyệt thành công'));	
		}else{
			return \Redirect('gene')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa duyệt được, vui lòng thử lại'));
		}
	}
}
