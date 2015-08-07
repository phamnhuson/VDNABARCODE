<?php
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Validator;
	
	class BlastController extends Controller
	{
	
		function index()
		{
			return view('blast');
		}
	
		function blast(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'sequence'	=>	'in:A,T,G,C'
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
						->withErrors($validator)
						->withInput();
						
			} else {
			
				
				
			}
		}
	
	}
	