<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class OrderController extends Controller {
	
	public function index(Request $request)
	{					
		$orderId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($orderId);
		}
		
		if ($orderId)
		{						
			$order = DB::table('order')->where('order_id', $orderId)->get();
			$viewData['order'] = $order;				
		}
		
		$list_class = DB::table('class')->get();
		
		$viewData['list_class']=$list_class;					
		
		$list_order = DB::table('order')
								->join('class','order.class_id','=','class.class_id')
								->select('order.order_id', 'order.order_name', 'order.description','class.class_id','class.class_name')
								->paginate(10);
		
		$viewData['list_order']=$list_order;

		return view('systems.order')->with('data',$viewData);		
	}
	
	public function create(Request $request)
	{
		$user=Session::get('user');
		$validator = Validator::make($request->all(), [
			'class_id'		=>	'required',
			'order_name' 	=>	'required|unique:order',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$order = DB::table('order');
			
			$inputData = $request->only('order_name', 'description','class_id');			
			
			if ($order->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'class_id'		=>	'required',
			'order_name' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$orderId = $request->get('order_id');
				
			$inputData = $request->only('order_name', 'description','class_id');			

			if (DB::table('order')->where('order_id', $orderId)->update($inputData)) {
				
				return redirect('order')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($orderId)
	{
		if (DB::table('order')->where('order_id', $orderId)->delete()) {
			
			return \Redirect('order')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('order')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
