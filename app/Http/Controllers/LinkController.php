<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\City;

class LinkController extends Controller {
	
	public function index(Request $request)
	{					
		$linkId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($linkId);
		}
		
		if ($linkId)
		{						
			$link = DB::table('link')->where('link_id', $linkId)->get();
			$viewData['link'] = $link;				
		}
		
		$linkes = DB::table('link')->paginate(10);
		
		$viewData['list_link']=$linkes;
		
		return view('systems.link')->with('data',$viewData);	
	}
	
	public function create(Request $request)
	{
		$user=Session::get('user');
		$validator = Validator::make($request->all(), [
			'link_name' =>	'required|unique:link',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$link = DB::table('link');
			
			$inputData = $request->only('link_name');
			
			$inputData['created'] = date('Y-m-d h:i:s');
			
			$inputData['created_by'] = $user['id'];
			
			if ($link->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		$user=Session::get('user');
		
		$validator = Validator::make($request->all(), [
			'link_name' =>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$linkId = $request->get('link_id');
				
			$inputData = $request->only('link_name');
			
			$inputData['updated'] = date('Y-m-d h:i:s');
			
			$inputData['updated_by'] = $user['id'];
			
			if (DB::table('link')->where('link_id', $linkId)->update($inputData)) {
				
				return redirect('link')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($linkId)
	{
		if (DB::table('link')->where('link_id', $linkId)->delete()) {
			
			return \Redirect('link')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('link')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
	
}
