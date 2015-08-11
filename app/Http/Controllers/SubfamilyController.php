<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SubfamilyController extends Controller {
	
	public function index(Request $request)
	{	
		$subfamilyId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($subfamilyId);
		}
		
		if ($subfamilyId)
		{						
			$subfamily = DB::table('subfamily')->where('subfamily_id', $subfamilyId)->get();
			$viewData['subfamily'] = $subfamily;				
		}
		
		$list_order = DB::table('order')->get();
		
		$viewData['list_order']=$list_order;									

		return view('systems.subfamily')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'order_id'		=>	'required',
			'subfamily_name' 	=>	'required|unique:subfamily',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$subfamily = DB::table('subfamily');
			
			$inputData = $request->only('subfamily_name', 'description','order_id');			
			
			if ($subfamily->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'order_id'		=>	'required',
			'subfamily_name' 	=>	'required',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$subfamilyId = $request->get('subfamily_id');
				
			$inputData = $request->only('subfamily_name', 'description','order_id');			

			if (DB::table('subfamily')->where('subfamily_id', $subfamilyId)->update($inputData)) {
				
				return redirect('subfamily')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($subfamilyId)
	{
		if (DB::table('subfamily')->where('subfamily_id', $subfamilyId)->delete()) {
			
			return \Redirect('subfamily')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('subfamily')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
