<?php namespace App\Http\Controllers;

	class PhylogeneticController extends Controller
	{
		function index()
		{
			$phyloData = file_get_contents(storage_path().'/linux/ete2-2.3.6/tree/clustalo_default-none-none-fasttree_full/nucleotide_db.final_tree.nw');
			
			$viewData = array('phyloData' => $phyloData);
			
			return view('phylotree', $viewData);
		}
		
		function update()
		{
			chdir("/var/www/html/dnabarcode/storage/linux");
			exec("ete build -a fasta/nucleotide_db -o ete2-2.3.6/tree  -w standard_fasttree --noimg", $output, $retval);
			if($retval)
				return \Redirect::back();
		}
		
	}