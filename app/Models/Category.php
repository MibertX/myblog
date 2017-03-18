<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * Model's database table
	 *
	 * @var string
	 */
	protected $primaryKey = 'category_id';

	/**
	 * Many to many relations.
	 * Get posts that has this category.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function posts()
	{
		return $this->belongsToMany('App\Models\Post', 'post_category', 'post_id', 'category_id');
	}
}
