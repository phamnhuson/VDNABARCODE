<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Auth;

class GenomeController extends Controller {
	
	public function index(Request $request)
	{			
		$viewData=array();
	
		$genomeId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($genomeId);
		}
		
		if ($genomeId)
		{						
			$genome = DB::table('genome')->where('id', $genomeId)->get();
			$viewData['genome'] = $genome;				
		}
		
		
		
		$list_kingdom = DB::table('kingdom')->get();
		
		$viewData['list_kingdom']=$list_kingdom;	
				
		$list_genome = DB::table('genome')->join('kingdom', 'kingdom.kingdom_id', '=', 'genome.kingdom')->select('genome.*', 'kingdom.kingdom_name')->paginate(10);
		
		$viewData['list_genome']=$list_genome;

		return view('igenome')->with('data',$viewData);
		
	}
	
	public function showList($id = null)
	{
		$breadcrumbs = array(array('name' => 'Genome', 'url' => '/genome'));
		if ($id) {
		
			$genome = DB::table('genome')->join('kingdom', 'kingdom.kingdom_id', '=', 'genome.kingdom')->select('genome.*', 'kingdom.kingdom_name')->where('kingdom.kingdom_id', '=', $id)->paginate(10);
			$viewData['genome'] = $genome;
			
			$kingdom = DB::table('kingdom')->where('kingdom_id', '=', $id)->get();
			
			$breadcrumbs[] = array('name' => $kingdom[0]['kingdom_name']);
			
		} else {
		
			$kingdom = DB::table('kingdom')->get();
			$viewData['kingdom'] = $kingdom;
			
		}
		
		
		$viewData['breadcrumbs'] = $breadcrumbs;
		
				
		
		return view('genome')->with($viewData);
	
	}
	
	public function update(Request $request)
	{	
						
		$validator = Validator::make($request->all(), [
			'kingdom'	=>	'required',
			'title' 	=>	'required',
			'url' 	=>	'required'
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$genomeId = $request->get('genome_id');
				
			$inputData = $request->only('title', 'url','kingdom');			

			if (DB::table('genome')->where('id', $genomeId)->update($inputData)) {
				
				return redirect('igenome')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
			
	}
	
	function delete($genomeId)
	{
		if (DB::table('genome')->where('id', $genomeId)->delete()) {
			
			return \Redirect('igenome')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('igenome')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
	
	public function create(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'kingdom'	=>	'required',
			'title' 	=>	'required',
			'url'		=>	'required'
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$genome = DB::table('genome');
			
			$inputData = $request->only('kingdom', 'title','url');			
			
			if ($genome->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
}
