<?php namespace App\Http\Controllers;
use DB;
use Validator; 
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Repositories\Fastas\NucleotideRepository;

class MessageController extends Controller {
	
	public function index(Request $request)
	{			   
		$list_message = DB::table('message')->paginate(20);		
		$viewData['list_message']=$list_message;
		return view('message')->with('data',$viewData);
	}
	
	public function update(Request $request){
		$validator = Validator::make($request->all(), [
			'id_message'		=>	'required',
			'email_message' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        }else{
			$messageId = $request->get('id_message');
				
			$inputData = $request->only('answers');
			
			$inputData['status'] = 1;
			
			$answers = $request->get('answers');
			
			if (DB::table('message')->where('id', $messageId)->update($inputData)) {
				
				return redirect('message')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
				
				return redirect('message')->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));	
				
			}
		}
	}

}
