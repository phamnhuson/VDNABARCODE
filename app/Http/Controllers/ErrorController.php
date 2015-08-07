<?php
	namespace App\Http\Controllers;
	
	class ErrorController extends Controller
	{
	
		function index()
		{
			$logContent = file_get_contents(base_path().'/log/error.log');
			
			$viewData = array('logContent' => $logContent);
			
			return view('error', $viewData);
			
		}
	
		function clear()
		{
			file_put_contents(base_path().'/log/error.log', '');
			
			return \Redirect::back();
		}
	
	}