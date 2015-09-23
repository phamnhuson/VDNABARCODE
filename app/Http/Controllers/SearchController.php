<?php
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	
	class SearchController extends Controller
	{
	
		protected $searchResult;
		protected $searchType;
		protected $searchContent;
		protected $barcode;
	
		function __construct()
		{
			$this->barcode = DB::table('barcode');
		}
	
		function index($searchType = 'keyword')
		{
			$viewData = array('searchType' => $searchType);
			return view('search', $viewData);
		}
	
		function search(Request $request)
		{
			
			
			if($request->get('search_type'))
			{
			
				$this->searchType = $request->get('search_type');
				$this->searchContent = $request->get('search_content');
				
			} else {
			
				$this->searchType = $request->input('search_type');
				$this->searchContent = $request->input('search_content');
				
			}
			
			$this->searchProccess();
			
			$viewData = array(
							'searchType'	=>		$this->searchType,
							'searchContent'	=>		$this->searchContent,
							'searchResult'	=>		$this->searchResult
						);
			
			return view('search', $viewData);
			
		}
		
		function searchProccess()
		{
		
			$this->barcode
				 ->select('barcode.*')
				 ->leftjoin('species', 'species.species_id', '=', 'barcode.species')
				 ->leftjoin('barcode2city', 'barcode2city.barcode_id', '=', 'barcode.barcode_id')
				 ->leftjoin('city', 'city.city_id', '=', 'barcode2city.city_id');
		
			switch ($this->searchType) {
				case 'keyword':
					$this->searchByKeyword();
					break;
				case 'sequence':
					$this->searchBySequence();
					break;
				case 'id':
					$this->searchById();
					break;
				// case 'time':
					// $this->searchByTime();
					// break;
				default: return false;	
			}
			
			$this->searchResult = $this->barcode->get();
			
		}
		
		function searchByKeyword()
		{
			$this->barcode
				->where('barcode.common_name', 'LIKE', "%".$this->searchContent."%")
				->orwhere('barcode.vietnamese_name', 'LIKE', "%".$this->searchContent."%")
				->orwhere('barcode.scientific_name', 'LIKE', "%".$this->searchContent."%")
				->orwhere('species.species_name', 'LIKE', "%".$this->searchContent."%");
		}
	
		function searchBySequence()
		{
			$this->barcode
				 ->where('barcode.sequence', 'LIKE', "%{$this->searchContent}%")
				 ->orwhere('barcode.peptide', 'LIKE', "%{$this->searchContent}%");
		}
	
		function searchByLocation()
		{
			$this->barcode
				 ->where('city.city_name', 'LIKE', "%{$this->searchContent}%");
		}
	
		function searchById()
		{
			$this->barcode
				 ->where('barcode.barcode_id', '=', $this->searchContent);
		}
	
		function searchByTime()
		{
			$this->barcode
				 ->where('barcode.collected_date', '=', $this->searchContent);
		}
	
	}