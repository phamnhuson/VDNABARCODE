<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;

class IbarcodeController extends Controller {
	
	public function index(Request $request)
	{	
	
		$barcodeId = $request->get('id');
		
		$action = $request->get('action');
		
		$loca=array();
		
		if($action=='delete')
		{
			return $this->delete($barcodeId);
		}
		
		if ($barcodeId)
		{						
			$barcode = DB::table('barcode')->where('barcode.barcode_id', $barcodeId)->get();
			
			$file_img = DB::table('file_img')->where('file_img.barcode_id',$barcodeId)->get();
			
			$file_trace = DB::table('file_trace')->Where('file_trace.barcode_id',$barcodeId)->get();
			
			$location = DB::table('location')->Where('location.barcode_id',$barcodeId)->get();
			
			$viewData['location'] = $location;						
			
			foreach($location as $key=>$lc)
			{
				$loca[$key][]='';
				$loca[$key][]=$lc['latitude'];
				$loca[$key][]=$lc['longitude'];
			}				
			
			$viewData['file_trace'] = $file_trace;
						
			$viewData['barcode'] = $barcode;
			
			$viewData['file_img'] = $file_img;
			
		}
		
		$list_species = DB::table('species')->get();
						
		$arr_species=array();
		
		foreach($list_species as $sp)
		{
			$arr_species[$sp['species_id']]=$sp['species_name'];
		}
		
		$viewData['arr_species']=$arr_species;
		
		$viewData['loca'] = json_encode($loca);	

		return view('ibarcode')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{		

		$validator = Validator::make($request->all(), [
			'sequence'		=>	'required',
			//'quality'		=>	'required',
			'barcode' 		=>	'required',
			'taxon_id'		=>	'required',
			'species' 		=>	'required',
		]);
		
		$error=0;
		
		if ($validator->fails()) {
		
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$barcode = DB::table('barcode');
			
			$inputData = $request->only('sequence','peptide','seq_size','pep_size','gene','start','stop','life_stage','taxon_id','organelle','barcode','sex','tissue_type','notes','extra_info','reproduction','lineage','collector','collected_date','species');			
			
			$inputData['stop']= $this->stopCodonDetect($request['sequence']);
			
			if($request['quality']!=''){
				$inputData['quality']= $this->calFastqAvgQuality($request['quality']);
			}else{
				$inputData['quality']='';
			}

			if ($barcode->insert($inputData)) {
				
				$id	=	DB::getPdo()->lastInsertId();
				
				$inputData=array();								
				
				foreach($request['images'] as $img)
				{
					if($img!='')
					{
						$inputData['barcode_id'] = $id;
					
						if(DB::table('file_img')->insert($inputData))
						{
							$id_img = DB::getPdo()->lastInsertId();							
						
							$move=$img->move(		
						
							base_path() . '/public/uploads/img/', $id_img.'.jpg'
							
							);
							
							if(!$move)
							{
								$error=1;
							};
							
						}else{
							$error=1;
						}
					}					
				};
				
				foreach($request['files'] as $file)
				{
					if($file!='')
					{
						$inputData['barcode_id'] = $id;
						
						if(DB::table('file_trace')->insert($inputData))
						{
							$id_file = DB::getPdo()->lastInsertId();						
								
							$mime=$file->getClientOriginalName();
							
							$ext = pathinfo($mime, PATHINFO_EXTENSION);
						
							$move=$file->move(		
						
							base_path() . '/public/uploads/file/', 'file_'.$id_file.'.'.$ext
							
							);
							
							if($move){
								
								$updateData = array();
								
								$updateData['file_name']= 'file_'.$id_file.'.'.$ext;

								$move=DB::table('file_trace')->where('file_id', $id_file)->update($updateData);
								
								if(!$move)
								{
									$error=1;
								}
								
							}else{
								$error=1;
							}
							
						}else{
							$error=1;
						}
					}
				}
			
				foreach($request['longitude'] as $key=>$kd)
				{
					
					if($kd!='')
					{
						
						$locationData = array();
						
						$locationData['barcode_id'] = $id;
						
						$locationData['longitude'] = $kd;
						
						$locationData['latitude'] = $request['latitude'][$key];
						
						$insert=DB::table('location')->insert($locationData);
						
						if(!$insert)
						{
							$error=1;
						};
						
					};
				}
					
			} else {
			
				$error=1;				
			
			};
			
			if($error==0){
				
				return \Redirect('barcode')->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
				
			}else{
				
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			}

		}
		
	}
	
	public function update(Request $request)
	{	

		$error=0;
		
		$validator = Validator::make($request->all(), [
			'sequence'		=>	'required',
			//'quality'		=>	'required',
			'barcode' 		=>	'required',
			'taxon_id'		=>	'required',
			'species' 		=>	'required',
		]);
		
		if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
						
        } else {

			$barcodeId = $request->get('barcode_id');
						
			$inputData = $request->only('sequence','peptide','seq_size','pep_size','gene','start','stop','life_stage','taxon_id','organelle','barcode','sex','tissue_type','notes','extra_info','reproduction','lineage','collector','collected_date','species');			
			
			$inputData['stop']= $this->stopCodonDetect($request['sequence']);
			
			if($request['quality']!=''){
				$inputData['quality']= $this->calFastqAvgQuality($request['quality']);
			}else{
				$inputData['quality']='';
			}

			DB::table('barcode')->where('barcode_id', $barcodeId)->update($inputData);
				
			$inputData=array();
			
			$inputData['barcode_id'] = $barcodeId;
			
			foreach($request['images'] as $img)
			{
				if($img!='')
				{
					
					if(DB::table('file_img')->insert($inputData))
					{
						$id_img = DB::getPdo()->lastInsertId();							
					
						$move=$img->move(		
					
						base_path() . '/public/uploads/img/', $id_img.'.jpg'
						
						);
						
						if(!$move){
							$error=1;
						}
						
					}else{
						$error=1;
					}
				}					
			};
			
			foreach($request['files'] as $file)
			{
				if($file!='')
				{
					
					if(DB::table('file_trace')->insert($inputData))
					{
						$id_file = DB::getPdo()->lastInsertId();						
							
						$mime=$file->getClientOriginalName();
						
						$ext = pathinfo($mime, PATHINFO_EXTENSION);
					
						$move=$file->move(		
					
						base_path() . '/public/uploads/file/', 'file_'.$id_file.'.'.$ext
						
						);
						
						if($move){
							
							$updateData = array();
							
							$updateData['file_name']= 'file_'.$id_file.'.'.$ext;

							$move=DB::table('file_trace')->where('file_id', $id_file)->update($updateData);
							
							if(!$move)
							{
								$error=1;
							}
							
						}else{
							$error=1;
						}
						
					}else{
						$error=1;
					}
				}
			};
			
			foreach($request['longitude'] as $key=>$kd)
			{
				
				if($kd!='')
				{
					
					$locationData = array();
					
					$locationData['barcode_id'] = $barcodeId;
					
					$locationData['longitude'] = $kd;
					
					$locationData['latitude'] = $request['latitude'][$key];
					
					$insert=DB::table('location')->insert($locationData);
					
					if(!$insert)
					{
						$error=1;
					};
					
				};
			}

			if($error==0){
				
				return \Redirect('barcode')->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			}else{
				
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			}

		}
	}
	
	function stopCodonDetect($sequence)
	{
	 
		$stopCodon = array("TAG", "TAA", "TGA");
		  
		$hasStopCodon = false;
	  
		foreach ($stopCodon AS $sc) {
	  
			for ($i=0; $i<=2; $i++) {
				if (strpos(substr($sequence, $i), $sc)) {
					$hasStopCodon = true;
					break;
				}
				if (strpos(strrev(substr($sequence, $i)), $sc)) {
					$hasStopCodon = true;
					break;
				}
			}
	  
		}
	   
		return $hasStopCodon;
	}
	
	function calFastqAvgQuality($quality)
	{
		file_put_contents($quality, storage_path('linux').'avg_qual.fastq');
		chdir(storage_path('linux'));
		system(config('app.fastq_qual_check_path').' < avg_qual.fastq', $avgQuality);
		return $avgQuality;
	}
	
	public function delete_img(Request $request)
	{
		$id=$request->get('id');
		$path= 'public/uploads/img/'.$id.'.jpg';
		if(File::delete($path))
		{
			
			if(DB::table('file_img')->where('file_id', $id)->delete())
			{
				echo json_encode("correct");
			}
			
		}
	}
	
	public function delete_file(Request $request)
	{
		$id=$request->get('id');
		$file_trace = DB::table('file_trace')->Where('file_trace.file_id',$id)->get();
		$path= 'public/uploads/file/'.$file_trace[0]['file_name'];
		if(File::delete($path))
		{
			
			if(DB::table('file_trace')->where('file_id', $id)->delete())
			{
				echo json_encode("correct");
			}
			
		}
	}
	
	public function delete_loca(Request $request)
	{
		$id=$request->get('id');
		
		if(DB::table('location')->where('location_id', $id)->delete())
		{
			echo json_encode("correct");
		}
		
	}
	
}
