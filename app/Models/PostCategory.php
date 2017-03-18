<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'post_category';

	/**
	 * As this is an intermediate table of manytomany relation
	 * between posts and categories - we don't need the autoincrementing primary key,
	 * becouse this table's primary key is composite.
	 *
	 * @var bool
	 */
	public $incrementing = false;
}
