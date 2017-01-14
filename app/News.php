<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class News
 * @package App
 * @property id
 * @property $text
 * @property $title
 * @property $author
 * @property $categories
 */

class News extends Model
{
	/**
	 * The database table that used by this model
	 *
	 * @var string
	 */
	protected $table = 'news';


	/**
	 * Disk-driver, that laravel used to create and store files created by this model.
	 * For now only local disk is needed.
	 *
	 * @var string
	 */
	protected $defaultDisk = 'local';


	/**
	 * This is default directory for storing files created by this model.
	 *
	 * @var string
	 */
	protected $defaultDir = 'news';


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


	/**
	 * Better to save all categories in only one field in DB,
	 * so all categories that have been choosen - transformed into a string from the array.
	 * Each category in this string separated by ', '.
	 *
	 * @param array $data
	 * @return string
	 */
	public static function categoriesToStr($data) {
		$categories = [];
		foreach ($data as $key=>$value) {
			if(array_key_exists($key, News::$categories)) {
				$categories[$key] = $value;
			}
		}
		return implode(', ', $categories);
	}


	/**
	 * Array with static rules for validation of user input
	 *
	 * @return array
	 */
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


	/**
	 * Save the text of the article in .txt file.
	 * Return a boolean if there is a need only to edit an existing article or
	 * return a path to the created file if it's the new one (for saving in DB later).
	 *
	 * @param string $text
	 * @return bool|string
	 */
	public function saveInTxtFile($text)
	{
		if(Storage::disk($this->defaultDisk)) {
			//For editing the text of the existing article - return bool
			if($this->text) {
				Storage::put($this->text, $text);
				return true;
			}

			//For creating the .txt file for the new article - return a path to this file.
			$dir = $this->defaultDir . DIRECTORY_SEPARATOR . str_replace(' ', '_', strtolower($this->title));
			$file_path = $dir . DIRECTORY_SEPARATOR . 'text.txt';
			Storage::put($file_path, $text);
			
			return $file_path;
		}
	}
}
