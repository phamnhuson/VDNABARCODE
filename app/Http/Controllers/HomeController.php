<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('pages.home');
    }
}