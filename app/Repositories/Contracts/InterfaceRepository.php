<?php
	namespace Repositories\Constracts;
	
	interface InterfaceRepository
	{
	
		public function all();
		
		public function find($id);
		
		public function findBy($attribute, $value);
		
		public function create($input);
		
		public function update($input, $id, $attributeId = 'id');
		
		public function delete($id, $attributeId = 'id');
	
	}