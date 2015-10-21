<?php namespace App\Http\Controllers;

	use DB;

	class MemberController extends Controller
	{
	
		function index()
		{
			$users = DB::table('users')->where('status', 1)->orderBy('priority', 'ASC')->orderBy('created_at', 'ASC')->paginate(20);;
			return view('member', compact('users'));
		}
	
	}