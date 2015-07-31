<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;

class LoginController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function index()
	{
		//
	}
	
	public function login()
	{
		$errors=array();
		return view('pages.login')->with("erv",$errors);
		
		
	}

	public function postlogin(Request $request)
	{
		$data=$request;
		$validator = Validator::make(
			array(
				'name' => $data['name'],
				'password' => $data['password'],
			),
			array(
				'name' => 'required',
				'password' => 'required|min:6',
			)
		);
		if ($validator->fails())
		{	
			$errors=json_decode($validator->messages(), true);
			return view('pages.login')->with("erv",$errors);;
		}else{
			$check = DB::table('user')->where('user_name', $data['name'])->get();
			if(!empty($check))
			{
				if($check[0]['password']==md5($data['password']))
				{
					session()->regenerate();
					Session::put('user', $check[0]);
					return redirect('admin');
				}else{
					$errors=array(
									'password'=>array
										(
											'0'=>'The password you entered is incorrect.'
										),
									'note'=>array
										(
											'0'=>'Please try again (make sure caps lock is off).'
										)
								 );
					return view('pages.login')->with("erv",$errors);;
				}
			}else{
				$errors=array(
								'name'=>array
									(
										'0'=>'Email you entered is not in any of the accounts.'
									),
								'note'=>array
									(
										'0'=>'Be sure to enter your information correctly.'
									)
							 );
				return view('pages.login')->with("erv",$errors);;
			}
		}
	}
	
	public function logout()
	{
		Session::forget('user');
		return redirect('login');
	}
}
