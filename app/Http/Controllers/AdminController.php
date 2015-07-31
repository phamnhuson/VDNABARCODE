<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function index()
	{		
		if(Session::has('user'))
		{
			/*
			$value = Session::get('user');
			echo "<pre>";
			print_r($value);
			echo "</pre>";
			*/
		}else
		{
			return redirect('login');
		}
		return view('admin.index');
	}
}
