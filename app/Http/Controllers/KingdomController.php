<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class KingdomController extends Controller {
	
	public function index(Request $request)
	{	
		
		$kingdomId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($kingdomId);
		}
		
		if ($kingdomId)
		{						
			$kingdom = DB::table('kingdom')->where('kingdom_id', $kingdomId)->get();
			$viewData['kingdom'] = $kingdom;				
		}
				
		$list_kingdom = DB::table('kingdom')->paginate(10);
		
		$viewData['list_kingdom']=$list_kingdom;

		return view('systems.kingdom')->with('data',$viewData);

	}
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'kingdom_name' 	=>	'required|unique:kingdom',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$kingdom = DB::table('kingdom');
			
			$inputData = $request->only('kingdom_name', 'description');			
			
			if ($kingdom->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'kingdom_name' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$kingdomId = $request->get('kingdom_id');
				
			$inputData = $request->only('kingdom_name', 'description');			

			if (DB::table('kingdom')->where('kingdom_id', $kingdomId)->update($inputData)) {
				
				return redirect('kingdom')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($kingdomId)
	{
		if (DB::table('kingdom')->where('kingdom_id', $kingdomId)->delete()) {
			
			return \Redirect('kingdom')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('kingdom')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
