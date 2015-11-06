<?php namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index($pageId)
    {
		$page = DB::table('news')->where('news.new_id', $pageId)->get();
		return view('page')->with('page', $page[0]);
	}

}	