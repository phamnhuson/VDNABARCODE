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
		
			
		
			switch ($this->searchType) {
				case 'barcode':
					$this->searchBarcode();
					break;
				case 'member':
					$this->searchMember();
					break;
				case 'public':
					$this->searchPublic();
					break;
				case 'gene':
					$this->searchGene();
					break;	
				default: return false;	
			}
			
			
			
		}
		
		function searchBarcode() {
			
			$this->barcode
					->select('barcode.*', 'species.species_name', 'genus.genus_name', 'family.family_name', 'order.order_name', 'class.class_name', 'phylum.phylum_name')
					->leftjoin('species', 'species.species_id', '=', 'barcode.species')
					->leftjoin('genus', 'species.genus_id', '=', 'genus.genus_id')
					->leftjoin('family', 'genus.family_id', '=', 'family.family_id')
					->leftjoin('order', 'family.order_id', '=', 'order.order_id')
					->leftjoin('class', 'order.class_id', '=', 'class.class_id')
					->leftjoin('phylum', 'class.phylum_id', '=', 'phylum.phylum_id')
					->leftjoin('kingdom', 'phylum.kingdom_id', '=', 'kingdom.kingdom_id')
					->leftjoin('barcode2city', 'barcode2city.barcode_id', '=', 'barcode.barcode_id')
					->leftjoin('city', 'city.city_id', '=', 'barcode2city.city_id')
					->where('barcode.status', '=', 1)
					->where(function($query){
						$query->orwhere('species.other_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('species.vietnamese_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('species.species_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('genus.genus_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('family.family_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('order.order_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('class.class_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('phylum.phylum_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('kingdom.kingdom_name', 'LIKE', "%".$this->searchContent."%")
								->orwhere('barcode.sequence', 'LIKE', "%{$this->searchContent}%")
								->orwhere('barcode.peptide', 'LIKE', "%{$this->searchContent}%")
								->orwhere('barcode.barcode_id', '=', $this->searchContent);
					});
					
				 
			$this->searchResult = $this->barcode->paginate(10);
		}
	
		function searchPublic() {
			$news = DB::table('news');
			$news->select('*')
					->where('status', '=', 1)
					->where('category', '=', 0)
					->where('subject', 'LIKE', "%".$this->searchContent."%");
			$this->searchResult = $news->paginate(10);
		}
		
		function searchGene() {
			$gene = DB::table('gene');
			$gene->select('*')
				->where('status', '=', 1)
				->where(function($query){
					$query->orwhere('gene_name', 'LIKE', "%{$this->searchContent}%")
							->orwhere('title', 'LIKE', "%{$this->searchContent}%");
				});
				
				
			$this->searchResult = $gene->paginate(10);
		}
		
		function searchMember() {
			$member = DB::table('users');
			$member->select('*')
				->where('status', '=', 1)
				->where('fullname', 'LIKE', "%".$this->searchContent."%");
			$this->searchResult = $member->paginate(10);		
		}
	
	}