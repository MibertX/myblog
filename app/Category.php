<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Category extends Model
{
	public static $table_name = 'categories';
	
	public static function getAllCategories()
	{
//		return DB::table(self::$table_name)->pluck('name');
		return Category::all();
	}

	public function articles()
	{
		return $this->belongsToMany('App/Article', 'article_category', 'article_id', 'category_id');
	}

	protected $primaryKey = 'category_id';
}
