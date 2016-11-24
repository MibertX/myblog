<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	/**
	 * The database table that used by this model
	 *
	 * @var string
	 */
    protected $table = 'news';


	/**
	 * Only this fields can be used for DB's mass-assignment
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'author',
		'path'
	];


	
}
