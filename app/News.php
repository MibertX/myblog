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
		'text',
		'categories'
	];


	/**
	 * The categories of articles
	 *
	 * @var array
	 */
	public static $categories = array(
		'it'         => 'IT',
		'php'        => 'PHP',
		'laravel'    => 'Laravel',
		'developing' => 'Разработка',
		'gadgets'    => 'Гаджеты',
		'android'    => 'Аndroid',
		'ios'        => 'iOS',
		'windows'    => 'Windows'
	);


	public static function categoriesToStr($data) {
		$categories = [];
		foreach ($data as $key=>$value) {
			if(array_key_exists($key, News::$categories)) {
				$categories[$key] = $value;
			}
		}
		return implode(', ', $categories);
	}
	
	
	public static function getValidationRules()
	{
		// проинициализируем массив статичеческими правилами
		$validation = array(
			'title' => 'required|min:3|max:250',
			'categories' => 'required',
			'text' => 'required|min:10'
		);

		return $validation;
	}
}
