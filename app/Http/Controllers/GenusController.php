<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class GenusController extends Controller {
	
	public function index(Request $request)
	{					
		$genusId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($genusId);
		}
		
		if ($genusId)
		{						
			$genus = DB::table('genus')->where('genus_id', $genusId)->get();
			$viewData['genus'] = $genus;				
		}
		
		$list_family = DB::table('family')->get();
		
		$viewData['list_family']=$list_family;					
		
		$list_genus = DB::table('genus')
								->join('family','genus.family_id','=','family.family_id')
								->select('genus.genus_id', 'genus.genus_name', 'genus.description','family.family_id','family.family_name')
								->paginate(10);
		
		$viewData['list_genus']=$list_genus;

		return view('systems.genus')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'family_id'		=>	'required',
			'genus_name' 	=>	'required|unique:genus',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$genus = DB::table('genus');
			
			$inputData = $request->only('genus_name', 'description','family_id');			
			
			if ($genus->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'family_id'		=>	'required',
			'genus_name' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$genusId = $request->get('genus_id');
				
			$inputData = $request->only('genus_name', 'description','family_id');			

			if (DB::table('genus')->where('genus_id', $genusId)->update($inputData)) {
				
				return redirect('genus')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($genusId)
	{
		if (DB::table('genus')->where('genus_id', $genusId)->delete()) {
			
			return \Redirect('genus')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('genus')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
