<?php
	
	namespace Repositories\Abstracts;
	use Repositories\Constracts\InterfaceRepository;

	abstract class AbstractEloquentRepository implements InterfaceRepository
	{
	
		protected $dataFileName;
		protected $reader;
		protected $tmpReader;
	
		public function __construct()
		{
			$this->dbFile =  storage_path().'linux/fasta/'.$this->dataFileName;
			$this->tmpReader = fopen(torage_path().'linux/fasta/tmp_db',"a");
			fwrite($this->tmpReader,'');
			$this->reader = fopen($this->dbFile, 'r');
		}
	
		public function all()
		{
			
		}
	
		public function find($id)
		{
			
		}
		
		public function findBy($attribute, $value)
		{
			
		}
	
		public function create($data)
		{
			return $this->fastaHandler($data, 'insert');
		}
		
		public function update($data)
		{
			return $this->fastaHandler($data, 'update');
		}
		
		public function delete($data)
		{
			return $this->fastaHandler($data, 'delete');
		}
		
		public function fastaHandler($data, $action = null)
		{
			try {
				$cursor = 0;
				$newline = ">gi|".$data['id']."\n".$data['sequence'];
			
				if ($action=='insert') {
				
					fputs($this->tmpReader, "\n".$newline);
					
				} elseif (filesize($this->reader)) {
				
					while(!feof($this->reader))
					{
						$line = fgets($this->reader);
						
						if (trim($line)=='') {
						
							$cursor=0;
							
						}
						
						if (strpos($line, '>gi|'.$data['id'])===0) {
							$cursor = 1;
							if ($action == 'update') {
							
								fputs($this->tmpReader, $newline);
								
							}	
						}

						if ($cursor == 0) {
						
							fputs($this->tmpReader, $line);
							
						}	
					}
				}
				
				fclose($this->tmpReader);
				fclose($this->reader);
				
				unlink($this->dbFile);
				rename(torage_path().'linux/fasta/tmp_db', $this->dbFile);
				
				// Call make database function
				chdir(storage_path().'linux/fasta/');
				system(config('app.blast_tool_path')." -in ".$this->dataFileName." -input_type fasta -dbtype nucl -out ".$this->dataFileName, $retVal);
				
				return true;
				
			} catch(Exception $e) {
			
				throw new Exception($e);
				return false;
				
			}
			
		}
		
	}