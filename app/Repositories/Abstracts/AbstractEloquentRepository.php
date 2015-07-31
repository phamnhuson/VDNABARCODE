<?php

	namespace Repositories\Abstracts;
	
	use Repositories\Constracts\InterfaceRepository;

	abstract class AbstractEloquentRepository implements InterfaceRepository
	{
	
		protected $model;
		
		public function __construct()
		{
			$this->model = app()->make($this->model);
		}
	
		public function all()
		{
			return $this->model->all();
		}
	
		public function find($id)
		{
			return $this->model->find($id);
		}
		
		public function findBy($attribute, $value)
		{
			return $this->model->where($attribute, '=', $value)->get();
		}
	
		public function create($input)
		{
			return $this->model->create($input);
		}
		
		public function update($input, $id, $attributeId = 'id')
		{
			return $this->model->find($id)->update($input);
		}
		
		public function delete($id, $attributeId = 'id')
		{
			return $this->model->find($id)->delete();
		}
	
	}