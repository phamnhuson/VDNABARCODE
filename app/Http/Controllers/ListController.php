<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{

	protected $breadcrumbs = array();
	
    public function index($cat = null, $id = null)
    {

		if (!$cat) {
			$resource = \App\Models\Kingdom::select('kingdom.kingdom_name as name', 'kingdom.kingdom_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/kingdom/', kingdom.kingdom_id) AS url"));
			$resourceData = $resource
							->join('phylum', 'kingdom.kingdom_id', '=', 'phylum.kingdom_id','left outer')
							->join('class', 'phylum.phylum_id', '=', 'class.phylum_id','left outer')
							->join('order', 'class.class_id', '=', 'order.class_id','left outer')
							->join('family', 'order.order_id', '=', 'family.order_id','left outer')
							->join('genus', 'family.family_id', '=', 'genus.family_id','left outer')
							->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
							->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
							->groupBy('kingdom.kingdom_id','kingdom.kingdom_name')
							->paginate(20);
		} else {
			switch ($cat)
			{
				case 'kingdom':
					$resource = \App\Models\Kingdom::find($id);
					
					$resourceData = $resource->phylums()->select('phylum.phylum_name as name', 'phylum.phylum_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/phylum/', phylum.phylum_id) AS url"))
					->join('class', 'phylum.phylum_id', '=', 'class.phylum_id','left outer')
					->join('order', 'class.class_id', '=', 'order.class_id','left outer')
					->join('family', 'order.order_id', '=', 'family.order_id','left outer')
					->join('genus', 'family.family_id', '=', 'genus.family_id','left outer')
					->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
					->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
					->groupBy('phylum.phylum_id','phylum.phylum_name')
					->paginate(20);

					array_unshift($this->breadcrumbs, array('name' => $resource->kingdom_name));
					break;
					
				case 'phylum':
					$resource = \App\Models\Phylum::find($id);
					
					$resourceData = $resource->classes()->select('class.class_name as name', 'class.class_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/class/', class.class_id) AS url"))
														->join('order', 'class.class_id', '=', 'order.class_id','left outer')
														->join('family', 'order.order_id', '=', 'family.order_id','left outer')
														->join('genus', 'family.family_id', '=', 'genus.family_id','left outer')
														->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
														->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
														->groupBy('class.class_id','class.class_name')
														->paginate(20);
					
					array_unshift($this->breadcrumbs, array('name' => $resource->phylum_name));
					array_unshift($this->breadcrumbs, array('name' => $resource->kingdom->kingdom_name, 'url' => '/dnabarcode/kingdom/'.$resource->kingdom->kingdom_id));
					break;
					
				case 'class':
					$resource = \App\Models\Classes::find($id);
					
					$resourceData = $resource->orders()->select('order.order_name as name', 'order.order_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/order/', order.order_id) AS url"))
														->join('family', 'order.order_id', '=', 'family.order_id','left outer')
														->join('genus', 'family.family_id', '=', 'genus.family_id','left outer')
														->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
														->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
														->groupBy('order.order_id','order.order_name')
														->paginate(20);
					
					array_unshift($this->breadcrumbs, array('name' => $resource->class_name));
					array_unshift($this->breadcrumbs, array('name' => $resource->phylum->phylum_name, 'url' => '/dnabarcode/phylum/'.$resource->phylum->phylum_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->phylum->kingdom->kingdom_name, 'url' => '/dnabarcode/kingdom/'.$resource->phylum->kingdom->kingdom_id));
					break;	
					
				case 'order':
					$resource = \App\Models\Order::find($id);
					
					$resourceData = $resource->families()->select('family.family_name as name', 'family.family_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/family/', family.family_id) AS url"))
															->join('genus', 'family.family_id', '=', 'genus.family_id','left outer')
															->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
															->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
															->groupBy('family.family_id','family.family_name')
															->paginate(20);
					
					array_unshift($this->breadcrumbs, array('name' => $resource->order_name));
					array_unshift($this->breadcrumbs, array('name' => $resource->classes->class_name, 'url' => '/dnabarcode/class/'.$resource->classes->class_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->classes->phylum->phylum_name, 'url' => '/dnabarcode/phylum/'.$resource->classes->phylum->phylum_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->classes->phylum->kingdom->kingdom_name, 'url' => '/dnabarcode/kingdom/'.$resource->classes->phylum->kingdom->kingdom_id));
					break;	
					
				case 'family':
					$resource = \App\Models\Family::find($id);
					
					$resourceData = $resource->genus()->select('genus.genus_name as name', 'genus.genus_id as id', DB::raw('count(barcode.barcode_id) as count'), DB::raw("CONCAT('/dnabarcode/genus/', genus.genus_id) AS url"))
														->join('species', 'genus.genus_id', '=', 'species.genus_id','left outer')
														->groupBy('genus.genus_id','genus.genus_name')
														->join('barcode', 'barcode.species', '=', 'species.species_id','left outer')
														->paginate(20);
					
					array_unshift($this->breadcrumbs, array('name' => $resource->family_name));
					array_unshift($this->breadcrumbs, array('name' => $resource->order->order_name, 'url' => '/dnabarcode/order/'.$resource->order->order_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->order->classes->class_name, 'url' => '/dnabarcode/class/'.$resource->order->classes->class_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->order->classes->phylum->phylum_name, 'url' => '/dnabarcode/phylum/'.$resource->order->classes->phylum->phylum_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->order->classes->phylum->kingdom->kingdom_name, 'url' => '/dnabarcode/kingdom/'.$resource->order->classes->phylum->kingdom->kingdom_id));
					break;

				case 'genus':
					$resource = \App\Models\Genus::find($id);
					
					$resourceData = $resource->species()->select('species.species_name as name', DB::raw("CONCAT('/viewbarcode?id=' , barcode_id) AS url"))->join('barcode', 'barcode.species', '=', 'species.species_id')->where('barcode.status', 1)->paginate(20);
					
					array_unshift($this->breadcrumbs, array('name' => $resource->genus_name));
					array_unshift($this->breadcrumbs, array('name' => $resource->family->family_name, 'url' => '/dnabarcode/family/'.$resource->family->order_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->family->order->order_name, 'url' => '/dnabarcode/order/'.$resource->family->order->order_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->family->order->classes->class_name, 'url' => '/dnabarcode/class/'.$resource->family->order->classes->class_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->family->order->classes->phylum->phylum_name, 'url' => '/dnabarcode/phylum/'.$resource->family->order->classes->phylum->phylum_id));
					array_unshift($this->breadcrumbs, array('name' => $resource->family->order->classes->phylum->kingdom->kingdom_name, 'url' => '/dnabarcode/kingdom/'.$resource->family->order->classes->phylum->kingdom->kingdom_id));
					break;	
			}
		}	

		array_unshift($this->breadcrumbs, array('name' => 'DNA Barcode', 'url' => '/dnabarcode'));
		
		$viewData = array(
			'resource'	=>	$resourceData,
			'breadcrumbs'	=>	$this->breadcrumbs,
			'cat'=>$cat
		);
		
		return view('list')->with($viewData);
	}
	
	public function kingdom($id)
	{
		$resource = \App\Models\Kingdom::find($id);
		$name = $resource->kingdom_name;
		$breadcrumbs[] = array('name' => $name);
		$resourceData = $resource->phylums->paginate();
	}

}	