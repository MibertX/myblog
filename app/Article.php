<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Date\DateFormat;
use App\Text;

/**
 * Class Article
 * @package App
 * @property $article_id
 * @property $title
 * @property $author_id
 * @property $views
 * @property $short_month
 * @property $short_day
 * @property $text
 */


class Article extends Model
{

//	public function __construct()
//	{
//		$text = Article::find($this->article_id)->text()->get();
//		$this->text = $text->text;
//	}

	/**
	 * The database table that used by this model
	 *
	 * @var string
	 */
	protected $table = 'articles';


	/**
	 * Primary key table used
	 *
	 * @var string
	 */
	protected $primaryKey = 'article_id';


	/**
	 * Only this fields can be used for DB's mass-assignment
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
	];


	/**
	 * One-to-one relationship with App\text
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function text()
	{
		return $this->hasOne('App\Text', 'article_id', 'article_id');
	}



	/**
	 * Many-to-many relationships with App\Category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function categories()
	{
		return $this->belongsToMany('App\Category', 'article_category', 'article_id', 'category_id');
	}


	/**
	 * Transform timestamp from created_at field into a string,
	 * and create 'short_month' and 'short_day' attributes.
	 *
	 * @param $time
	 * @return string|\Symfony\Component\Translation\TranslatorInterface
	 */
	public function getCreatedAtAttribute($time)
	{
		$this->short_month = date('M', strtotime($time));
		$this->short_day   = date('d', strtotime($time));
		return DateFormat::when($time);
	}

	/**
	 * Transform timestamp from updated_at field into a string
	 *
	 * @param $time
	 * @return string|\Symfony\Component\Translation\TranslatorInterface
	 */
	public function getUpdatedAtAttribute($time)
	{
		return DateFormat::when($time);
	}


	/**
	 * This method save all required data for just created article in DB:
	 *   title in 'articles' table,
	 *   many-to-many relationship(s) with App\Category in 'article_category' table,
	 *   one-to-one relationship with App\Text and the text of the article in 'texts' table. 
	 * 
	 * @param $data
	 */
	public function saveInDataBase($data)
	{
		// !!!Observers and exception will be added soon !!!
		$this->title = $data['title'];
		$this->save();
		$this->categories()->attach($data['categories']);
		$articleText = new Text(['text' => $data['text']]);
		$this->text()->save($articleText);
	}


	/**
	 * Array with static rules for validation of user input
	 *
	 * @return array
	 */
	public static function getValidationRules()
	{
		$validation = array(
			'title' => 'required|min:3|max:250',
//			'author_id' => 'required|int'
		);

		return $validation;
	}
}
