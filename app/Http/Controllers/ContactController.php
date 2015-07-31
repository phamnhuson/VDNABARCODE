<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Repositories\Eloquents\MessageRepository;
use Carbon\Carbon;

class ContactController extends Controller
{
    protected $message;
	
	function __construct(MessageRepository $message)
	{
		$this->message = $message;
	}
	
    public function index()
    {
		return view('contact');
	}
	
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'subject'	=>	'required',
			'content'	=>	'required',
			'email'		=>	'required|email'
		]);
		
		if ($validator->fails()) {
		
			return \Redirect::back()
					->withErrors($validator)
					->withInput();
					
		} else {
		
			$messageData = $request->only('email', 'subject', 'content');
			$messageData['date'] = Carbon::now();
			
			if ($this->message->create($messageData)) {
				
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Tin nhắn của bạn đã được gửi đi'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có sự cố xảy ra, vui lòng thử lại'));
				
			}
			
		}
		
	}

}	