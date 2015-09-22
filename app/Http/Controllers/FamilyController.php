<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FamilyController extends Controller {
	
	public function index(Request $request)
	{	
		$familyId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($familyId);
		}
		
		if ($familyId)
		{						
			$family = DB::table('family')->where('family_id', $familyId)->get();
			$viewData['family'] = $family;				
		}
		
		$list_order = DB::table('order')->get();
		
		$viewData['list_order']=$list_order;					
		
		$list_family = DB::table('family')
								->join('order','family.order_id','=','order.order_id')
								->select('family.family_id', 'family.family_name', 'family.description','order.order_id','order.order_name')
								->paginate(10);
		
		$viewData['list_family']=$list_family;

		return view('systems.family')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'order_id'		=>	'required',
			'family_name' 	=>	'required|unique:family',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$family = DB::table('family');
			
			$inputData = $request->only('family_name', 'description','order_id');			
			
			if ($family->insert($inputData)) {
		
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
			'family_name' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$familyId = $request->get('family_id');
				
			$inputData = $request->only('family_name', 'description','order_id');			

			if (DB::table('family')->where('family_id', $familyId)->update($inputData)) {
				
				return redirect('family')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($familyId)
	{
		if (DB::table('family')->where('family_id', $familyId)->delete()) {
			
			return \Redirect('family')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('family')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
