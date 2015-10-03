<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;
use App\Repositories\Fastas\NucleotideRepository;
use Parser;
use Auth;

class IbarcodeController extends Controller {
	
	protected $nuRepo;
	
	function __construct()
	{
		$this->nuRepo = new NucleotideRepository;
	}
	
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
			
			$plantae = DB::table('species')
								->join('genus','genus.genus_id','=','species.genus_id')
								->join('family','family.family_id','=','genus.family_id')
								->join('order','order.order_id','=','family.order_id')
								->join('class','class.class_id','=','order.class_id')
								->join('phylum','phylum.phylum_id','=','class.phylum_id')
								->where('species.species_id',$barcode[0]['species'])
								->get();
								
			$viewData['plantae'] = $plantae;
			
			//$file_img = DB::table('file_img')->where('file_img.barcode_id',$barcodeId)->get();
			
			$file_trace = DB::table('file_trace')->Where('file_trace.barcode_id',$barcodeId)->paginate(10);
			
			$barcode2city = DB::table('barcode2city')
												->join('city','city.city_id','=','barcode2city.city_id')
												->where('barcode2city.barcode_id',$barcodeId)
												->paginate(10);
												
			$viewData['barcode2city'] = $barcode2city;	
			
			$location = DB::table('location')->Where('location.barcode_id',$barcodeId)->paginate(5);
			
			$viewData['location'] = $location;						
			
			foreach($location as $key=>$lc)
			{
				$loca[$key][]='';
				$loca[$key][]=$lc['latitude'];
				$loca[$key][]=$lc['longitude'];
			}				
			
			$viewData['file_trace'] = $file_trace;
						
			$viewData['barcode'] = $barcode;
			
			//$viewData['file_img'] = $file_img;
			
		}		
		
		$list_phylum = DB::table('phylum')->get();
						
		$arr_phylum=array();
		
		$arr_phylum[0] = "Chọn ngành";
		
		foreach($list_phylum as $pl)
		{
			$arr_phylum[$pl['phylum_id']]=$pl['phylum_name'];
		}		
		
		$viewData['arr_phylum']=$arr_phylum;
		
		$arr_class=array();				
		
		$arr_class[0] = "Chọn lớp";
		
		$list_class = DB::table('class')->get();
		
		foreach($list_class as $cl)
		{
			$arr_class[$cl['class_id']]=$cl['class_name'];
		}
		
		$viewData['arr_class']=$arr_class;
		
		$arr_order=array();
		
		$arr_order[0] = "Chọn bộ";
		
		$list_order = DB::table('order')->get();
		
		foreach($list_order as $od)
		{
			$arr_order[$od['order_id']]=$od['order_name'];
		}
		
		$viewData['arr_order']=$arr_order;
		
		$arr_family=array();
		
		$arr_family[0] = "Chọn họ";
		
		$list_family = DB::table('family')->get();
		
		foreach($list_family as $fm)
		{
			$arr_family[$fm['family_id']]=$fm['family_name'];
		}
		
		$viewData['arr_family']=$arr_family;
		
		$arr_genus=array();
		
		$arr_genus[0] = "Chọn chi";
		
		$list_genus = DB::table('genus')->get();
		
		foreach($list_genus as $gn)
		{
			$arr_genus[$gn['genus_id']]=$gn['genus_name'];
		}
		
		$viewData['arr_genus']=$arr_genus;
		
		$arr_species=array();
		
		$arr_species[0] = "Chọn loài";
		
		$list_species = DB::table('species')->get();
		
		foreach($list_species as $sp)
		{
			$arr_species[$sp['species_id']]=$sp['species_name'];
		}
		
		$viewData['arr_species']=$arr_species;
		
		$list_city = DB::table('city')->get();
						
		$arr_city=array();		
		
		foreach($list_city as $ct)
		{
			$arr_city[$ct['city_id']]=$ct['city_name'];
		}
		
		$viewData['list_city']=$list_city;
		
		$viewData['arr_city']=$arr_city;
		
		$viewData['loca'] = json_encode($loca);

		return view('ibarcode')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{	
		$user = Session::get('user');
		
		$validator = Validator::make($request->all(), [
			'species'			=>	'required',
			'sequence'			=>	'required',
		]);
		
		$error=0;
		
		if ($validator->fails()) {			
            //return \Redirect::back()->with('errors',$validator->errors()->toArray());
			 return \Redirect::back()->withErrors($validator);
        } else {

			$barcode = DB::table('barcode');
			
			$inputData = $request->only('sample_id','museum_id','field_id','collection_code','deposited_in','species','bin','voucher_status','reproduction','tissue_type','sex','brief_note','taxon_id','life_stage','organelle','lineage','detailed_notes','sequence_id','gene','genbank_accession','genome','locus','quality','seq_size','sequence','pep_size','peptide','title','authors','address','submitted_date','phone','email','subfamily','country','date_collected','province_state','collectors','region_country','sector','exact_site','latitude','longitude','elevation','elv_accuracy','coord_source','depth','coord_accuracy','depth_accuracy','last_updated','fprimername','fprimer','rprimername','rprimer');			
			
			$inputData['stop']= $this->stopCodonDetect($request['sequence']);
			
			if($request['quality']!=''){
				$inputData['quality']= $this->calFastqAvgQuality($request['quality']);
			}else{
				$inputData['quality']='';
			}
			
			$inputData['created']=date('Y-m-d');
			
			$inputData['created_by']=$user['id'];
			
			if(Auth::user()->role == 3)
			{
				$inputData['status'] = 1;
			}
			
			if ($barcode->insert($inputData)) {
				
				$id	=	DB::getPdo()->lastInsertId();
				
				if(isset($inputData['status']) && $inputData['status'] == 1) {
					
					$species = DB::table('species')->where('species.species_id', $request['species'])->get();										
				
					$this->nuRepo->create(array('id' => $id, 'sequence' => $inputData['sequence'], 'name' => $species[0]['species_name']));
					
				}
				
				/*$cityData=array();
				
				foreach($request['cities'] as $ct)
				{
					if($ct!='')
					{
						$b2c = DB::table('barcode2city')->where('barcode2city.city_id', $ct)->get();
						if(empty($b2c))
						{
							$cityData['city_id'] = $ct;
				
							$cityData['barcode_id'] = $id;
							
							if(!DB::table('barcode2city')->insert($cityData))
							{
								$error=1;
							}
						}
					}
				};*/
				
				$inputData=array();								
				
				/*foreach($request['images'] as $img)
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
				};*/
				
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
						
							base_path() . '/public/uploads/file/barcode/', 'file_'.$id_file.'.'.$ext
							
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
			
				/*foreach($request['sector'] as $key=>$st)
				{
					
					if($st!='')
					{
						
						$locationData = array();
						
						$locationData['barcode_id'] = $id;
						
						$locationData['sector']		= $st;
						
						$locationData['longitude'] 	= $request['longitude'][$key];
						
						$locationData['latitude'] 	= $request['latitude'][$key];
						
						$insert=DB::table('location')->insert($locationData);
						
						if(!$insert)
						{
							$error=1;
						};
						
					};
				}*/
					
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
		
		$user = Session::get('user');
		
		$validator = Validator::make($request->all(), [
			'species'			=>	'required',
			'sequence'			=>	'required',
		]);
		
		if ($validator->fails()) {
			
            return \Redirect::back()->withErrors($validator);
						
        } else {

			$barcodeId = $request->get('barcode_id');
						
			$inputData = $request->only('sample_id','museum_id','field_id','collection_code','deposited_in','species','bin','voucher_status','reproduction','tissue_type','sex','brief_note','taxon_id','life_stage','organelle','lineage','detailed_notes','sequence_id','gene','genbank_accession','genome','locus','quality','seq_size','sequence','pep_size','peptide','title','authors','address','submitted_date','phone','email','subfamily','country','date_collected','province_state','collectors','region_country','sector','exact_site','latitude','longitude','elevation','elv_accuracy','coord_source','depth','coord_accuracy','depth_accuracy','last_updated','fprimername','fprimer','rprimername','rprimer');			
			
			$inputData['stop']= $this->stopCodonDetect($request['sequence']);
			
			if($request['quality']!=''){
				$inputData['quality']= $this->calFastqAvgQuality($request['quality']);
			}else{
				$inputData['quality']='';
			}
			
			$inputData['updated']=date('Y-m-d');
			
			$inputData['updated_by']=$user['id'];

			DB::table('barcode')->where('barcode_id', $barcodeId)->update($inputData);
			
			$barcode = DB::table('barcode')->where('barcode_id', $barcodeId)->get();
			
			if (!empty($barcode) && $barcode[0]['status'] == 1) {
				
				$species = DB::table('species')->where('species.species_id', $request['species'])->get();														
				
				$this->nuRepo->update(array('id' => $barcodeId, 'sequence' => $inputData['sequence'], 'name' => $species[0]['species_name']));
				
			}
			
			/*$cityData=array();
				
			foreach($request['cities'] as $ct)
			{
				if($ct!='')
				{
					$b2c = DB::table('barcode2city')->where('barcode2city.city_id', $ct)->get();
					if(empty($b2c))
					{
						$cityData['city_id'] = $ct;
			
						$cityData['barcode_id'] = $barcodeId;
						
						if(!DB::table('barcode2city')->insert($cityData))
						{
							$error=1;
						}
					}
				}
			};*/
				
			$inputData=array();
			
			$inputData['barcode_id'] = $barcodeId;
			
			/*foreach($request['images'] as $img)
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
			};*/
			
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
					
							base_path() . '/public/uploads/file/barcode/', 'file_'.$id_file.'.'.$ext
						
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
			
			/*foreach($request['sector'] as $key=>$st)
			{
				
				if($st!='')
				{
					
					$locationData = array();
					
					$locationData['barcode_id'] = $barcodeId;
					
					$locationData['sector'] 	= $st;
					
					$locationData['longitude'] = $request['longitude'][$key];
					
					$locationData['latitude'] = $request['latitude'][$key];
					
					$insert=DB::table('location')->insert($locationData);
					
					if(!$insert)
					{
						$error=1;
					};
					
				};
			}*/

			if($error==0){
				
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			}else{
				
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			}

		}
	}
	
	function stopCodonDetect($sequence)
	{
	 
		$sequence = preg_replace( "/\r|\n/", "", $sequence);
	 
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
	
	public function delete_city(Request $request)
	{
		$id=$request->get('id');
		
		if(DB::table('barcode2city')->where('id', $id)->delete())
		{
			echo json_encode("correct");
		}
		
	}
	
	public function exportFile(Request $request)
	{
		$barcodeId = $request->get('id');
		$type = $request->get('type');
		
		$barcode = DB::table('barcode')
			 ->select('barcode.*', 'species.species_name')
			 ->leftjoin('species', 'species.species_id', '=', 'barcode.species')
			 ->leftjoin('barcode2city', 'barcode2city.barcode_id', '=', 'barcode.barcode_id')
			 ->leftjoin('city', 'city.city_id', '=', 'barcode2city.city_id')
			 ->where('barcode.barcode_id', $barcodeId)
			 ->get();
		
		header('Cache-Control: public');
		$fileName = 'barcode_data.xml';
		$fileContent = "";
		
		switch ($type) {
			case 'json':
				header('Content-Type: application/json');
				$fileContent = json_encode($barcode[0]);
				$fileName = 'barcode_data.json';
				break;
			case 'tsv':	
				header('Content-Type: application/tsv');
				$fileContent = $this->makeTsvFile($barcode[0]);
				$fileName = 'barcode_data.txt';
				break;
			default:
				header('Content-Type: application/xml');
				break;
		}
		
		 
		
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		//header('Content-Length: '.filesize($file));
		echo $fileContent;
			 
	}
	
	function makeTsvFile($data)
	{
		$content = "";
		foreach ($data AS $key=>$field) {
			$content.=$key."\t";
		}
		$content = trim($content).PHP_EOL;
		foreach ($data AS $key=>$field) {
			$content.=$field."\t";
		}
		$content = trim($content);
		return $content;
	}
	
	public function importFromFile(Request $request)
	{
		// $file = file_get_contents(storage_path().'/xml/bold_data.txt');
		if ($request->hasFile('tsv'))
		{
			$filePath = storage_path().'/xml';
			$fileName = 'bold_data_'.time().'_'.rand(10, 999).'.txt';
			$request->file('tsv')->move($filePath, $fileName);
			$parsedArray = $this->tsv_to_array($filePath.'/'.$fileName);
			$parsedArray = $parsedArray[2];
			
			$barcode = DB::table('barcode');
				
			$phylum = $parsedArray['phylum_name'];
			$class = $parsedArray['class_name'];
			$order = $parsedArray['order_name'];
			$family = $parsedArray['family_name'];
			$genus = $parsedArray['genus_name'];
			$species = $parsedArray['species_name'];
				
			$existsPhylum = DB::table('phylum')->where('phylum_name', $phylum)->get();
			if (empty($existsPhylum)) {
				$phylumId = DB::table('phylum')->insertGetId(array('phylum_name' => $phylum));
			} else {
				$phylumId = $existsPhylum[0]['phylum_id'];
			}
			
			$existsClass = DB::table('class')->where('class_name', $class)->get();
			if (empty($existsClass)) {
				$classId = DB::table('class')->insertGetId(array('class_name' => $class, 'phylum_id' => $phylumId));
			} else {
				$classId = $existsClass[0]['class_id'];
			}
			
			$existsOrder = DB::table('order')->where('order_name', $order)->get();
			if (empty($existsOrder)) {
				$orderId = DB::table('order')->insertGetId(array('order_name' => $order, 'class_id' => $classId));
			} else {
				$orderId = $existsOrder[0]['order_id'];
			}
				
			$existsFamily = DB::table('family')->where('family_name', $family)->get();
			if (empty($existsFamily)) {
				$familyId = DB::table('family')->insertGetId(array('family_name' => $family, 'order_id' => $orderId));
			} else {
				$familyId = $existsFamily[0]['family_id'];
			}

			$existsGenus = DB::table('genus')->where('genus_name', $genus)->get();
			if (empty($existsGenus)) {
				$genusId = DB::table('genus')->insertGetId(array('genus_name' => $genus, 'family_id' => $familyId));
			} else {
				$genusId = $existsGenus[0]['genus_id'];
			}
			
			$existsSpecies = DB::table('species')->where('species_name', $species)->get();
			if (empty($existsSpecies)) {
				$speciesId = DB::table('species')->insertGetId(array('species_name' => $species, 'genus_id' => $genusId));
			} else {
				$speciesId = $existsSpecies[0]['species_id'];
			}
				
			$inputData = array(
				'sequence'	=>	$parsedArray['nucleotides'],
				//'peptide'	=>	$parsedArray[''],
				'seq_size'	=>	strlen($parsedArray['nucleotides']),
				//'pep_size','gene','start',
				'stop'		=>	$this->stopCodonDetect($parsedArray['nucleotides']),
				'life_stage'=>	$parsedArray['lifestage'],
				'taxon_id'	=>	str_replace('taxon:', '', $parsedArray['extrainfo']),
				//'common_name','scientific_name','vietnamese_name','organelle','barcode',
				'sex'		=>	$parsedArray['sex'],
				//'tissue_type','notes','extra_info','reproduction','lineage',
				'collector'	=>	$parsedArray['collectors'],
				'collected_date'	=>	$parsedArray['collectiondate'],
				'species'	=>	$speciesId,
				// 'quality'	=>
			);			

			if(Auth::user()->role == 3)
			{
				$inputData['status'] = 1;
			}
			
			if ($barcode->insert($inputData)) {
				
				$id	= DB::getPdo()->lastInsertId();
				
				if(isset($inputData['status']) && $inputData['status'] == 1) {
				
					$this->nuRepo->create(array('id' => $id, 'sequence' => $inputData['sequence'], 'name' => $inputData['scientific_name']));
					
				}
				
				$this->nuRepo->create(array('id' => $id, 'sequence' => $inputData['sequence'], 'name' => ''));
			
				if ($parsedArray['lat'] && $parsedArray['lon']) {
					DB::table('location')->insert(array('barcode_id' => $id, 'latitude' => $parsedArray['lat'], 'longitude' => $parsedArray['lon']));
				}
				
				return \Redirect('ibarcode?action=edit&id='.$id)->with('responseData', array('statusCode' => 1, 'message' => 'Nhập dữ liệu thành công'));
				
			}
		} else {
			return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'File không tồn tại hoặc không hợp lệ'));
		}
		
	}
	
	function tsv_to_array($file,$args=array()) {
		//key => default
		$fields = array(
			'header_row'=>true,
			'remove_header_row'=>true,
			'trim_headers'=>true, //trim whitespace around header row values
			'trim_values'=>true, //trim whitespace around all non-header row values
			'debug'=>false, //set to true while testing if you run into troubles
			'lb'=>"\n", //line break character
			'tab'=>"\t", //tab character
		);
		foreach ($fields as $key => $default) {
			if (array_key_exists($key,$args)) { $$key = $args[$key]; }
			else { $$key = $default; }
		}

		if (!file_exists($file)) {
			if ($debug) { $error = 'File does not exist: '.htmlspecialchars($file).'.'; }
			else { $error = 'File does not exist.'; }
			custom_die($error);
		}

		if ($debug) { echo '<p>Opening '.htmlspecialchars($file).'&hellip;</p>'; }
		$data = array();

		if (($handle = fopen($file,'r')) !== false) {
			$contents = fread($handle, filesize($file));
			fclose($handle);
		} else {
			custom_die('There was an error opening the file.');
		}

		$lines = explode($lb,$contents);
		if ($debug) { echo '<p>Reading '.count($lines).' lines&hellip;</p>'; }

		$row = 0;
		foreach ($lines as $line) {
			$row++;
			if (($header_row) && ($row == 1)) { $data['headers'] = array(); }
			else { $data[$row] = array(); }
			$values = explode($tab,$line);
			foreach ($values as $c => $value) {
				if (($header_row) && ($row == 1)) { //if this is part of the header row
					if (in_array($value,$data['headers'])) { custom_die('There are duplicate values in the header row: '.htmlspecialchars($value).'.'); }
					else {
						if ($trim_headers) { $value = trim($value); }
						$data['headers'][$c] = $value.''; //the .'' makes sure it's a string
					}
				} elseif ($header_row) { //if this isn't part of the header row, but there is a header row
					$key = $data['headers'][$c];
					if ($trim_values) { $value = trim($value); }
					$data[$row][$key] = $value;
				} else { //if there's not a header row at all
					$data[$row][$c] = $value;
				}
			}
		}

		if ($remove_header_row) {
			unset($data['headers']);
		}

		if ($debug) { echo '<pre>'.print_r($data,true).'</pre>'; }
		return $data;
	}
	
}
