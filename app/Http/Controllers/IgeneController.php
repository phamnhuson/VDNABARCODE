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

class IgeneController extends Controller {
	
	protected $nuRepo;
	
	function __construct()
	{
		$this->nuRepo = new NucleotideRepository;
	}
	
	public function index(Request $request)
	{			
		
		$sequence_id = $request->get('id');
		
		$action = $request->get('action');
		
		$viewData=array();
		
		if($action=='delete')
		{
			return $this->delete($barcodeId);
		}
		
		if ($sequence_id)
		{					
			
			$gene = DB::table('gene')->where('gene.sequence_id', $sequence_id)->get();
							
			$viewData['gene'] = $gene;	
			
		}

		return view('igene')->with('data',$viewData);
	}
	
	public function create(Request $request)
	{	
	
		$user = Session::get('user');
		
		$validator = Validator::make($request->all(), [
			'sequence_id'			=>	'required',
		]);
		
		if ($validator->fails()) {			
            //return \Redirect::back()->with('errors',$validator->errors()->toArray());
			 return \Redirect::back()->withErrors($validator);
        } else {
			$gene = DB::table('gene');
			
			$inputData = $request->only('title','sequence_id','source_organism','author','address','project_name','level','published','gene_name','size','mol_type','cds','cds_size','codon_start','product','function_feature','nucleotide_sequence','amino_acid_sequence');
			
			$inputData['created_by'] = $user['id'];

			if ($gene->insert($inputData)) {
				return \Redirect('gene')->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			}else{
				
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			}

		}
		
	}
	
	public function update(Request $request)
	{	

		$user = Session::get('user');
		
		$validator = Validator::make($request->all(), [
			'sequence_id'			=>	'required',
		]);
		
		if ($validator->fails()) {
			
            return \Redirect::back()->withErrors($validator);
						
        } else {

			$sequence_id = $request->get('sequence_id');
						
			$inputData = $request->only('title','source_organism','author','address','project_name','level','published','gene_name','size','mol_type','cds','cds_size','codon_start','product','function_feature','nucleotide_sequence','amino_acid_sequence');

			if(DB::table('gene')->where('sequence_id', $sequence_id)->update($inputData)){
				
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
			}else{
				
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
			}

		}
	}
}
