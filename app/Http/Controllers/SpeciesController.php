<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SpeciesController extends Controller {
	
	public function index(Request $request)
	{	
		
		$speciesId = $request->get('id');
		
		$action = $request->get('action');
		
		if($action=='delete')
		{
			return $this->delete($speciesId);
		}
		
		if ($speciesId)
		{						
			$species = DB::table('species')->where('species_id', $speciesId)->get();
			$viewData['species'] = $species;				
		}
		
		$list_genus = DB::table('genus')->get();
		
		$viewData['list_genus']=$list_genus;					
		
		$list_species = DB::table('species')
								->join('genus','species.genus_id','=','genus.genus_id')
								->select('species.species_id', 'species.species_name', 'species.description','genus.genus_id','genus.genus_name')
								->paginate(10);
		
		$viewData['list_species']=$list_species;

		return view('systems.species')->with('data',$viewData);

	}
	
	public function create(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'genus_id'		=>	'required',
			'species_name' 	=>	'required|unique:species',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$species = DB::table('species');
			
			$inputData = $request->only('species_name', 'description','genus_id');			
			
			if ($species->insert($inputData)) {
		
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}

		}
		
	}
	
	public function update(Request $request)
	{	
		
		$validator = Validator::make($request->all(), [
			'genus_id'		=>	'required',
			'species_name' 	=>	'required',
		]);
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {
			$speciesId = $request->get('species_id');
				
			$inputData = $request->only('species_name', 'description','genus_id');			

			if (DB::table('species')->where('species_id', $speciesId)->update($inputData)) {
				
				return redirect('species')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			} else {
			
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
			
			}
		}
	}
	
	function delete($speciesId)
	{
		if (DB::table('species')->where('species_id', $speciesId)->delete()) {
			
			return \Redirect('species')->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
			
		} else {
		
			return \Redirect('species')->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa được, vui lòng thử lại'));
		
		}
	}
}
