<?php
	namespace App\Http\Controllers;
	
	class BackupController extends Controller
	{
	
		function index()
		{
		
			$listFile = glob(storage_path().'/backup/*');
			$fileData = array();
			
			foreach ($listFile AS $file) {
				$fileName = explode('/', $file);
				$fileName = end($fileName);
				$fileData[] = array(
								'name'	=>	$fileName,
								'size'	=>	number_format(filesize($file) / 1048576, 2).' Mb',
								'time'	=>	date('d/m/Y H:i:s', filemtime($file)),
								'link'	=>	route('backup_download', [ 'file' => $fileName ])
							);

			}
			
			$viewData = array('fileData' => $fileData);
			
			return view('backup', $viewData);
			
		}
		
		public function getDownload($fileName){
				
				$file = storage_path(). "/backup/$fileName";
				$headers = array(
				  'Content-Type: application/file',
				);
				return \Response::download($file, $fileName, $headers);
				
		}

	}