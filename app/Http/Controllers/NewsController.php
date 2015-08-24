<?php namespace App\Http\Controllers;
use DB;
use Validator; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NewsController extends Controller {
	
	public function index(Request $request)
	{

		$newId = $request->get('id');
		
		$action = $request->get('action');
		
		$viewData = array();				
		
		if($newId)
		{
			$new = DB::table('news')
							->join('users','news.created_by','=','users.id')
							->where('news.new_id', $newId)->get();
			
			$viewData['new']=$new;
			
			$list_comment = DB::table('comments')->where('comments.new', $newId)->get();
			
			$viewData['list_comment']=$list_comment;

			$viewData['count']=count($list_comment);
			
			$created=explode(' ',$new[0]['created']);
			
			$date=explode('-',$created[0]);
			
			$time=explode(':',$created[1]);

			$viewData['date']=$date;
			
			$viewData['time']=$time;
			
			$viewData['new_id']=$newId;
			
			return view('vnew')->with('data',$viewData);
			
		}else{
			
			$list_new = DB::table('news')->join('users','news.created_by','=','users.id')->paginate(10);
			
			$viewData['list_new'] = $list_new;

			return view('news')->with('data',$viewData);
		}
		
		
	}
	
	public function comment(Request $request){		

		$validator = Validator::make($request->all(), [
			'comment'			=>	'required',
		]);
		
		if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$inputData = $request->only('comment','new','fullname','email');
			
			if(DB::table('comments')->insert($inputData))
			{
				return \Redirect('news?id='.$request['new'])->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			}else{
				return \Redirect('news?id='.$request['new'])->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			}
		}
	}

}
