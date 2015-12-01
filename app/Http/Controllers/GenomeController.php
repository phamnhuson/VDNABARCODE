<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Auth;

class GenomeController extends Controller {
	
	public function index()
	{			
		
		$viewData=array();
		
		$genome = DB::table('genome')->join('kingdom', 'kingdom.kingdom_id', '=', 'genome.kingdom')->select('genome.*', 'kingdom.kingdom_name')->get();
						
		$viewData['genome'] = $genome;	
		
		return view('igenome')->with($viewData);
	}
	
	public function showList()
	{
	
		$genome = DB::table('genome')->join('kingdom', 'kingdom.kingdom_id', '=', 'genome.kingdom')->select('genome.*', 'kingdom.kingdom_name')->where('genome.url', '!=', '')->get();
		
		$viewData['genome'] = $genome;	
		
		return view('genome')->with($viewData);
	
	}
	
	public function update(Request $request)
	{	
						
			$inputData = $request->only('url');
			
			DB::beginTransaction();
			
			try {
			
				foreach ($inputData['url'] AS $id => $url) {
					DB::table('genome')->where('id', $id)->update(array('url' => $url));
				}
				
				DB::commit();
				
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
			
			} catch (Exception $e) {
			
				DB::rollBack();
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
			
	}
}
