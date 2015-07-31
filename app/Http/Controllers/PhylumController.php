<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PhylumController extends Controller {
	
	public function index(Request $request)
	{	
		
		$phylumId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($phylumId);
		}
		
		if ($phylumId)
		{						
			$phylum = DB::table('phylum')->where('phylum_id', $phylumId)->get();
			$viewData['phylum'] = $phylum;				
		}
				
		$list_phylum = DB::table('phylum')->paginate(10);
		
		$viewData['list_phylum']=$list_phylum;

		return view('systems.phylum')->with('data',$viewData);

	}
	
	public function create(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'phylum_name' 	=>	'required|unique:phylum',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$phylum = DB::table('phylum');
			
			$inputData = $request->only('phylum_name', 'description');			
			
			if ($phylum->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'phylum_name' 	=>	'required',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$phylumId = $request->get('phylum_id');
				
			$inputData = $request->only('phylum_name', 'description');			

			if (DB::table('phylum')->where('phylum_id', $phylumId)->update($inputData)) {
				
				return redirect('phylum')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($phylumId)
	{
		if (DB::table('phylum')->where('phylum_id', $phylumId)->delete()) {
			
			return \Redirect('phylum')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('phylum')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
