<?php

namespace App\Repositories;

abstract class BaseRepository
{
	protected $model;
	
	public $elementsPerPage = 5;
	
	public function findById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function destroyById($id)
	{
		return $this->model->destroy($id);
	}
}