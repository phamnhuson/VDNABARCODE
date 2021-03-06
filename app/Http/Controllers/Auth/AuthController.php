<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
        // return Validator::make($data, [
            // 'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|confirmed|min:6',
        // ]);
    // }

    // /**
     // * Create a new user instance after a valid registration.
     // *
     // * @param  array  $data
     // * @return User
     // */
    // protected function create(array $data)
    // {
        // return User::create([
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => bcrypt($data['password']),
        // ]);
    // }
	
	public function login()
	{
		return view('pages.login');
	}
	
	protected function authenticate(Request $request)
	{

		$loginData = array(
			'email'	=>	$request->input('email'),
			'password'	=>	$request->input('password')
		);
		
				
		if (Auth::attempt($loginData)) {
            
			$user = Auth::user()->toArray();
			
			Session::put('user', $user);
			
			$ss_id = Session::get('guest');
			
			DB::table('useronline')->where('user_id',$ss_id)->delete();
			
			DB::table('useronline')->insert(array('user_id'=>$user['id'],'time'=>time()));
			
			return redirect()->intended('user');
			
        } else {
		
			return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Thông tin đăng nhập không chính xác'));
			
		}
	}
	
	protected function logout()
	{
		$user = Session::get('user');
		DB::table('useronline')->where('user_id',$user['id'])->delete();
		Auth::logout();
		return redirect('/');
	}
	
}
