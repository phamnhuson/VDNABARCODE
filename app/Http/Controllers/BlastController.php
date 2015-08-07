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
				'sequence'	=>	'in:A,T,G,C'
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
						->withErrors($validator)
						->withInput();
						
			} else {
			
				$blastResult = $this->blastProccess($request->all());
				
				return view('blast', $blastResult);
				
			}
		}
	
		function blastProccess($request)
		{
			
			$blastTool = $request->input('tool');
			$threadsHold = $request->input('threadshold');
			$wordSize = $request->input('wordsize');
			$targetSeqs = $request->input('targetseqs');
			$scores	= $request->input('scores');
			$sequence = $request->input('sequence');
			
			$inputFile = storage_path().'linux/blast.input';
			file_put_contents($inputFile, $sequence);
			
			$command = storage_path()."blast+/bin/$blastTool -query ".storage_path()."linux/$inputFile -db ".storage_path()."linux/fasta/nucleotide_db -outfmt 5";
			
			if ($theadsHold) {
				$command .= " -num-threads $threadsHold";
			}
			
			if ($wordSize) {
				$command .= " -word_size $wordSize";
			}
			
			if ($targetSeqs) {
				$command .= " -max_target_seqs $targetSeqs";
			}
			
			system($command, $xml);
			
			$result = Parser::xml($xml);
			
			print_r($result);
			
		}
	
	}
	