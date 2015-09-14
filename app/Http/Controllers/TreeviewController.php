<?php namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	class TreeviewController extends Controller
	{
		function index($jobId = null)
		{
			$viewData = [];
			if($jobId)
			{
				@$phyloData = file_get_contents(storage_path().'/linux/ete2-2.3.6/treeview/'.$jobId.'/clustalo_default-none-none-fasttree_full/inputsequence.fa.final_tree.nw');
				if($phyloData){
					$sequence  = file_get_contents(storage_path().'/linux/ete2-2.3.6/treeview/'.$jobId.'/inputsequence.fa');
				
					$viewData['phyloData'] = $phyloData;
					$viewData['sequence'] = $sequence;
				}	
			}
			return view('treeview', $viewData);
		}
		
		function create(Request $request)
		{
			$jobId = uniqid();
			$sequence = $request->input('sequence');
			if ($sequence){
				chdir("/var/www/html/dnabarcode/storage/linux");
				mkdir(storage_path()."/linux/ete2-2.3.6/treeview/$jobId");
				file_put_contents(storage_path()."/linux/ete2-2.3.6/treeview/$jobId/inputsequence.fa", $sequence);
				exec("ete build -a ete2-2.3.6/treeview/$jobId/inputsequence.fa -o ete2-2.3.6/treeview/$jobId  -w standard_fasttree --noimg --tools-dir /home/juhuvn/.etetoolkit/ext_apps-latest", $output, $retval);
				if(isset($retval))
					return \Redirect("treeview/job/$jobId");
			}
			
		}
		
	}