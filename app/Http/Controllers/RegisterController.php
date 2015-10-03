<?php namespace App\Http\Controllers;

use DB;
use Hash;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;

class RegisterController extends Controller {
	
	public function index(Request $request)
	{	
		$viewData=array();		
		
		$action = $request->get('action');
		
		if($action=='edit'){
			$userId = Session::get('user')['id'];
			
			$user = DB::table('users')->where('users.id', $userId)->get();
			
			$viewData['user'] = $user;	
		}
	
		return view('pages.register')->with('data',$viewData);;
	}
	
	public function create(Request $request)
	{

		$validator = Validator::make($request->all(), [			
			'fullname' 	=>	'required',
			'email' 	=>	'required|unique:users',
			'password' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			
			$users = DB::table('users');
			
			$inputData = $request->only('fullname', 'email','phone','work_place','research', 'degree');
			
			$inputData['password'] = Hash::make($request['password']);
			
			if(isset($request['file'])){
				
				$inputData['file']=1;
				
			}else{
				$inputData['file']=0;
			}
			
			$inputData['role']	= 0;
			
			if ($users->insert($inputData)) {
				
				$id	=	DB::getPdo()->lastInsertId();
				
				if(isset($request['avata'])){									
					
					$move=$request['avata']->move(		
							
					base_path() . '/public/uploads/img/user_pictures/', 'avata_'.$id.'.jpg'
					
					);
					
				}
				
				if(isset($request['file']))
				{
					$mime=$request['file']->getClientOriginalName();
							
					$ext = pathinfo($mime, PATHINFO_EXTENSION);
					
					if($ext=='pdf')
					{
						$move=$request['file']->move(base_path() . '/public/uploads/file/user_cv', 'cv_'.$id.'.'.$ext);
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'lý lịch yêu cầu định dạng file pdf'));
					}
				}
				
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Tạo mới thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));			
			}

		}
		
	}
	
	public function update(Request $request)
	{	

		$error=0;
		
		$validator = Validator::make($request->all(), [
			'fullname' 	=>	'required',	
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
						
			$userId = $request->get('user_id');
			
			$data_user = DB::table('users')->where('users.id', $userId)->get();
		
			if(Hash::check($request['password_old'], $data_user[0]['password'])){
				
				$inputData = $request->only('fullname','phone','work_place','research', 'degree');
				
				if($request['password']!=''){
					$inputData['password'] = Hash::make($request['password']);
				}
				
				if(isset($request['file'])){

				$inputData['file']=1;
				
				}else{

					$inputData['file']=0;
				}
				
				DB::table('users')->where('id', $userId)->update($inputData);									
				
				if(isset($request['avata'])){
				
					$move=$request['avata']->move(		
							
					base_path() . '/public/uploads/img/user_pictures/', 'avata_'.$userId.'.jpg'
					
					);		
				}
				
				if(isset($request['file']))
				{
					$mime=$request['file']->getClientOriginalName();
							
					$ext = pathinfo($mime, PATHINFO_EXTENSION);
					
					if($ext=='pdf')
					{
						$move=$request['file']->move(base_path() . '/public/uploads/file/user_cv', 'cv_'.$userId.'.'.$ext);
					}else{
						$error=1;
					}
				}
				
				if($error==0)
				{
					return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				}else{
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Lý lịch yêu cầu định dạng file pdf'));
				}
				
			}else{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Mật khẩu cũ không đúng'));
			}
		}
	}
}
