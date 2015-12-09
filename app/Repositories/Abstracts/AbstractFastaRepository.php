<?php
	
	namespace App\Repositories\Abstracts;
	use Repositories\Constracts\InterfaceRepository;

	abstract class AbstractFastaRepository implements InterfaceRepository
	{
	
		protected $dataFileName;
		protected $reader;
		protected $tmpReader;
		protected $dbFile;
	
		public function __construct()
		{
			$this->dbFile =  storage_path().'/linux/fasta/'.$this->dataFileName;
			$this->tmpReader = fopen(storage_path().'/linux/fasta/tmp_db',"a");
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
		
		public function update($data, $id=null, $attributeId = 'id')
		{
			return $this->fastaHandler($data, 'update');
		}
		
		public function delete($data, $attributeId = 'id')
		{
			return $this->fastaHandler($data, 'delete');
		}
		
		public function fastaHandler($data, $action = null)
		{
			try {
				$cursor = 0;
				
				if (isset($data['sequence'])) {
					if (isset($data['new_id'])) {
						$newline = ">".$data['new_id']."_".$data['name']."\n".$data['sequence'];
					} else {	
						$newline = ">".$data['id']."_".$data['name']."\n".$data['sequence'];
					}	
				}
				
			
				if ($action=='insert') {
				
					fputs($this->tmpReader, file_get_contents($this->dbFile).$newline."\n\n");
					
				} elseif (filesize($this->dbFile)) {
				
					while(!feof($this->reader))
					{
						$line = fgets($this->reader);
						
						if (trim($line)=='') {
						
							$cursor=0;
							
						}
						
						if (strpos($line, '>'.$data['id']."_")===0) {
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
				rename(storage_path().'/linux/fasta/tmp_db', $this->dbFile);
				
				// Call make database function
				chdir(storage_path().'/linux/fasta/');
				system(storage_path().config('app.blast_tool_path')." -in ".$this->dataFileName." -input_type fasta -dbtype nucl -out ".$this->dataFileName, $retVal);
				
				return true;
				
			} catch(Exception $e) {
			
				throw new Exception($e);
				return false;
				
			}
			
		}
		
	}