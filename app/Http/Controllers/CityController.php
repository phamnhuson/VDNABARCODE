<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\City;

class CityController extends Controller {
	
	public function index(Request $request)
	{					
		$cityId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($cityId);
		}
		
		if ($cityId)
		{						
			$city = DB::table('city')->where('city_id', $cityId)->get();
			$viewData['city'] = $city;				
		}
		
		$cities = DB::table('city')->paginate(10);
		
		$viewData['list_city']=$cities;
		
		return view('systems.city')->with('data',$viewData);	
	}
	
	public function create(Request $request)
	{
		$user=Session::get('user');
		$validator = Validator::make($request->all(), [
			'city_name' =>	'required|unique:city',
			'zipcode' 	=>	'required|unique:city',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$city = DB::table('city');
			
			$inputData = $request->only('city_name', 'zipcode');
			
			$inputData['created'] = date('Y-m-d h:i:s');
			
			$inputData['created_by'] = $user['user_id'];
			
			if ($city->insert($inputData)) {
		
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
			'city_name' =>	'required',
			'zipcode' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$cityId = $request->get('city_id');
				
			$inputData = $request->only('city_name', 'zipcode');
			
			$inputData['updated'] = date('Y-m-d h:i:s');
			
			$inputData['updated_by'] = $user['user_id'];
			
			if (DB::table('city')->where('city_id', $cityId)->update($inputData)) {
				
				return redirect('city')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($cityId)
	{
		if (DB::table('city')->where('city_id', $cityId)->delete()) {
			
			return \Redirect('city')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('city')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
	
}
