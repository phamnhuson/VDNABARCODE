<?php namespace App\Http\Controllers;
use DB;
use Validator; 
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Repositories\Fastas\NucleotideRepository;
use Mail;
use Auth;
use File;

class InewController extends Controller {
	
	public function index(Request $request)
	{
		$user=Auth::user()->toArray();
		
		$newId = $request->get('id');
		
		$action = $request->get('action');
		
		$viewData['role'] = $user['role'];
		
		if($action=='delete')
		{
			return $this->delete($newId);
		}
		
		if($action=='accept')
		{
			return $this->accept($newId);
		}
		
		if($newId)
		{
			$new = DB::table('news')->where('news.new_id', $newId)->get();
			
			$viewData['new']=$new;
		}
		
		$list_new = DB::table('news')->where('category','!=',0)->where('created_by',$user['id'])->paginate(20);
		
		$viewData['list_new'] = $list_new;
		
		return view('inew')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{

		$user=Auth::user()->toArray();
		
		$error=0;
		
		$validator = Validator::make($request->all(), [
			'subject'			=>	'required',
			'summary' 			=>	'required',
			'content'			=>	'required',
		]);
		
		if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {			
			
			$inputData = $request->only('subject','summary','content','category');
			
			$inputData['created'] = date('Y-m-d H:i:s');
			
			$inputData['created_by']=$user['id'];
			
			if($request['category']==2){
				$inputData['status']=1;
			}
			
			if(DB::table('news')->insert($inputData))
			{
				$id_new = DB::getPdo()->lastInsertId();
				
				if($request['file']!='')
				{					
						
					$mime=$request['file']->getClientOriginalName();
					
					$ext = pathinfo($mime, PATHINFO_EXTENSION);
				
					$move=$request['file']->move(		
				
					base_path() . '/public/uploads/file/news/', 'new_'.$id_new.'.'.$ext
					
					);
					
					if($move){
						
						$inputData['new_file']='new_'.$id_new.'.'.$ext;
			
						if(!DB::table('news')->where('new_id', $id_new)->update($inputData)){
							$error=1;
						}
						
					}else{
						$error=1;
					}
				}
					
			}else{
				$error=1;
			};
			
			if($error==0){
				
				return \Redirect('inew')->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
				
			}else{
				
				return \Redirect('inew')->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			};
		}
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'subject'			=>	'required',
			'summary' 			=>	'required',
			'content'			=>	'required',
		]);
		
		if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			
			$user=Auth::user()->toArray();
		
			$error=0;
			
			$id_new=$request['id'];
			
			$inputData = $request->only('subject','summary','content','category');
			
			$inputData['updated'] = date('Y-m-d H:i:s');
			
			$inputData['updated_by']=$user['id'];
			
			if(DB::table('news')->where('new_id', $id_new)->update($inputData))
			{
				
				if($request['file']!='')
				{					
						
					$mime=$request['file']->getClientOriginalName();
					
					$ext = pathinfo($mime, PATHINFO_EXTENSION);
				
					$move=$request['file']->move(		
				
					base_path() . '/public/uploads/file/news/', 'new_'.$id_new.'.'.$ext
					
					);
					
					if($move){
						
						$inputData['new_file']='new_'.$id_new.'.'.$ext;
			
						if(!DB::table('news')->where('new_id', $id_new)->update($inputData)){
							$error=1;
						}
						
					}else{
						$error=1;
					}
				}
					
			}else{
				$error=1;
			};
			
			if($error==0){
				
				return \Redirect('inew')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			}else{
				
				return \Redirect('inew')->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			};
		}
	}
	
	function delete($newId)
	{

		if (DB::table('news')->where('new_id', $newId)->delete()) {			
			
			$nuRepo = new NucleotideRepository;
			$nuRepo->delete(array('id' => $newId));

			return \Redirect('inew')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
		} else {
		
			return \Redirect('inew')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));

		}
	}
	
	function accept($newId)
	{
		$update=array();
		$update['status']=1;
		if(DB::table('news')->where('new_id', $newId)->update($update)){				
			return \Redirect('inew')->with('responseData', array('statusCode' => 1, 'message' => 'Đã duyệt thành công'));	
		}else{
			return \Redirect('inew')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa duyệt được, vui lòng thử lại'));
		}
	}
}
