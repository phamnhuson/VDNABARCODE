<?php
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Validator;
	use Parser;
	
	class BlastController extends Controller
	{
	
		function index()
		{
			return view('blast');
		}
	
		function blast(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'sequence'	=>	'required|Regex:/^([ATGC\n]+)$/'
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
						->withErrors($validator)
						->withInput();
						
			} else {
				$viewData = array();
			
				$viewData['blastResult'] = $this->blastProccess($request->all());
				
				return view('blast', $viewData);
				
			}
		}
	
		function blastProccess($request)
		{
			
			$blastTool = storage_path()."/blast+/bin/".$request['tool'];
			$threadsHold = $request['threadshold'];
			$wordSize = $request['wordsize'];
			$targetSeqs = $request['targetseqs'];
			$scores	= $request['scores'];
			$sequence = $request['sequence'];
			
			$inputFile = storage_path().'/linux/blast.input';
			file_put_contents($inputFile, $sequence);
			
			$command = "$blastTool -query $inputFile -db ".storage_path()."/linux/fasta/nucleotide_db -outfmt 5";
			
			if ($threadsHold) {
				$command .= " -num-threads $threadsHold";
			}
			
			if ($wordSize) {
				$command .= " -word_size $wordSize";
			}
			
			if ($targetSeqs) {
				$command .= " -max_target_seqs $targetSeqs";
			}
			
			ob_start();
			system($command, $xml);
			$xml = ob_get_clean();
			
			$result = Parser::xml($xml);
			
			return $result;
			
		}
	
	}
	