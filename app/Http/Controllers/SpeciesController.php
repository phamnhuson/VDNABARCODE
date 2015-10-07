<?php namespace App\Http\Controllers;

use DB;
use Validator;
use File;
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
			$species = DB::table('species')
									->join('genus','genus.genus_id','=','species.genus_id')
									->join('family','family.family_id','=','genus.family_id')
									->join('order','order.order_id','=','family.order_id')
									->join('class','class.class_id','=','order.class_id')
									->join('phylum','phylum.phylum_id','=','class.phylum_id')
									->join('kingdom','kingdom.kingdom_id','=','phylum.kingdom_id')
									->where('species_id', $speciesId)->get();
			$viewData['species'] = $species;

			$file_img = DB::table('file_img')->where('file_img.species_id',$speciesId)->get();
		
			$viewData['file_img']=$file_img;
		}				
		
		$list_kingdom = DB::table('kingdom')->get();
		
		$viewData['list_kingdom']=$list_kingdom;
		
		$list_phylum = DB::table('phylum')->get();
		
		$viewData['list_phylum']=$list_phylum;
		
		$list_class = DB::table('class')->get();
		
		$viewData['list_class']=$list_class;
		
		$list_order = DB::table('order')->get();
		
		$viewData['list_order']=$list_order;
		
		$list_family = DB::table('family')->get();
		
		$viewData['list_family']=$list_family;
		
		$list_genus = DB::table('genus')->get();
		
		$viewData['list_genus']=$list_genus;		
		
		$list_species = DB::table('species')
								->join('genus','species.genus_id','=','genus.genus_id')
								->select('species.species_id', 'species.species_name', 'species.rank','genus.genus_id','genus.genus_name')
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
			
			$error=0;

			$species = DB::table('species');
			
			$inputData = $request->only('species_name','vietnamese_name','other_name','rank','distribution','function','conserve','other', 'species_description','genus_id');			
			
			if ($species->insert($inputData)) {
				
				$id	=	DB::getPdo()->lastInsertId();
				
				$inputData=array();								
				
				foreach($request['images'] as $img)
				{
					if($img!='')
					{
						$inputData['species_id'] = $id;
					
						if(DB::table('file_img')->insert($inputData))
						{
							$id_img = DB::getPdo()->lastInsertId();							
						
							$move=$img->move(		
						
							base_path() . '/public/uploads/img/', $id_img.'.jpg'
							
							);
							
							if(!$move)
							{
								return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra khi lưu trữ ảnh'));
							}else{
								return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
							}
							
						}else{
							return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra khi lưu trữ ảnh'));
						}
					}					
				};								
			
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
			$error=0;
			
			$speciesId = $request->get('species_id');
				
			$inputData = $request->only('species_name','vietnamese_name','other_name','rank','distribution','function','conserve','other', 'species_description','genus_id');			

			if (!DB::table('species')->where('species_id', $speciesId)->update($inputData)) {
				
				$error=1;					
				
			}
			
			$inputData=array();								
				
			foreach($request['images'] as $img)
			{
				if($img!='')
				{
					$inputData['species_id'] = $speciesId;
				
					if(DB::table('file_img')->insert($inputData))
					{
						$id_img = DB::getPdo()->lastInsertId();							
					
						$move=$img->move(		
					
						base_path() . '/public/uploads/img/', $id_img.'.jpg'
						
						);
						
						if(!$move)
						{
							$error=2;
						}
						
					}else{
						$error=3;
					}
				}					
			};
			
			if($error==0)
			{
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
			}
			
			if($error==1)
			{
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thông tin loài không thay đổi'));
			}
			
			if($error==2)
			{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra khi lưu thông tin ảnh'));
			}
			
			if($error==3)
			{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra khi lưu trữ ảnh'));
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
	
	public function get_species(Request $request){
		$genus_id = $request['id'];
		$species = DB::table('species')->where('genus_id', $genus_id)->get();
		echo json_encode($species);
	}
	
	public function viewspecies(Request $request)
	{
		$species_id = $request['id'];
		$species = DB::table('species')
							->join('genus','genus.genus_id','=','species.genus_id')
							->where('species_id', $species_id)
							->get();
							
		$viewData['species']=$species;
							
		$file_img = DB::table('file_img')->where('file_img.species_id',$species_id)->get();
		
		$viewData['file_img']=$file_img;
		
		return view('viewspecies')->with('data',$viewData);
	}
}
