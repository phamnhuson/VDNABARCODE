<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
	
    public function index(Request $request)
    {
		
		$users = User::paginate(10);
		
		$roles = DB::table('roles')->lists('role_name', 'id');
		
		$viewData = array('users' => $users, 'roles' => $roles);
		
		$userId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($userId);
		}
		
		if($action=='accept')
		{
			return $this->accept($userId);
		}
		
		if ($userId) {
			
			$user = User::find($userId);
			$viewData['user'] = $user;
			
		}
		
        return view('admin.user', $viewData);
    }
	
	public function create(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			// 'user_name' => 'required|unique:users',
			'email' => 'required|email|unique:users',
			'phone' => 'required|unique:users',
			'password'=>'required|same:repassword',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			
			$inputData = $request->only('email', 'password', 'fullname', 'phone', 'role', 'priority');
			$inputData['password'] = Hash::make($inputData['password']);
				
			if (User::insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{
	
		$validator = Validator::make($request->all(), [
			// 'user_name' => 'required|unique:users',
			'email' => 'required|email|unique:users',
			'phone' => 'required|unique:users',
			'password'=>'same:repassword',
			'id'	=>	'required|integer'
		]);
		
		$userId = $request->get('id');
			
		$inputData = $request->only('email', 'password', 'fullname', 'phone', 'role', 'priority');
		
		if ($inputData['password']) {
		
			$inputData['password'] = Hash::make($inputData['password']);	
			
		} else {
		
			unset($inputData['password']);
			
		}

		$user = User::findOrFail($userId);
		
		if ($user->update($inputData)) {
			
			return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
			
		} else {

			return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
		
		}
	}
	
	function delete($userId)
	{
		if (User::where('id', $userId)->delete()) {
			
			return \Redirect('user')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('user')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
	
	function accept($userId)
	{
		$update=array();
		$update['role']=1;
		if(DB::table('users')->where('id', $userId)->update($update)){
			return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Đã duyệt thành công'));	
		}else{
			return \Redirect::back()->with('responseData', array('statusCode' => 2, 'message' => 'Chưa duyệt được, vui lòng thử lại'));
		}
	}
}