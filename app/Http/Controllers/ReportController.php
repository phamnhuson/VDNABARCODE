<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
	 
    public function index(Request $request)
    {
		return view('report');
	}

}	