<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClassController extends Controller {
	
	public function index(Request $request)
	{					
		$classId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($classId);
		}
		
		if ($classId)
		{						
			$class = DB::table('class')->where('class_id', $classId)->get();
			$viewData['class'] = $class;				
		}
		
		$list_phylum = DB::table('phylum')->get();
		
		$viewData['list_phylum']=$list_phylum;					
		
		$list_class = DB::table('class')
								->join('phylum','class.phylum_id','=','phylum.phylum_id')
								->select('class.class_id', 'class.class_name', 'class.description','phylum.phylum_id','phylum.phylum_name')
								->paginate(10);
		
		$viewData['list_class']=$list_class;

		return view('systems.class')->with('data',$viewData);	
	}
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'phylum_id'		=>	'required',
			'class_name' 	=>	'required|unique:class',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$class = DB::table('class');
			
			$inputData = $request->only('class_name', 'description','phylum_id');			
			
			if ($class->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'phylum_id'		=>	'required',
			'class_name' 	=>	'required',
			'description' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$classId = $request->get('class_id');
				
			$inputData = $request->only('class_name', 'description','phylum_id');			
			
			if (DB::table('class')->where('class_id', $classId)->update($inputData)) {
				
				return redirect('class')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($classId)
	{
		if (DB::table('class')->where('class_id', $classId)->delete()) {
			
			return \Redirect('class')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('class')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
