<?php namespace App\Http\Controllers;

	use DB;

	class MemberController extends Controller
	{
	
		function index()
		{
			$users = DB::table('users')->where('status', 1)->orderBy('role', 'DESC')->get();
			return view('member', compact('users'));
		}
	
	}