<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
	public function __construct(Category $category)
	{
		$this->model = $category;
	}
	
	
	public function allCategories($ordered_collumn = 'categories.name', $direction='asc')
	{
		$categories = $this->prepareCategoriesQuery()->orderBy($ordered_collumn, $direction)->get();
		
		return $categories;
	}
	
	
	protected function prepareCategoriesQuery()
	{
		$query = $this->model
			->leftjoin('post_category', 'categories.category_id', '=', 'post_category.category_id')
			->select('categories.category_id', 'categories.name', DB::raw('count(post_category.post_id) as posts'))
			->groupBy('categories.category_id', 'categories.name');
		
		return $query;
	}
}

