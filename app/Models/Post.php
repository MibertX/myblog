<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Date\DateFormat;

class Post extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'posts';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'post_id';

	/**
	 * Transform timestamp from created_at field into a string,
	 * and create 'short_month' and 'short_day' attributes.
	 *
	 * @param $time
	 * @return string|\Symfony\Component\Translation\TranslatorInterface
	 */


	protected $fillable = [
		'title',
		'preview',
		'post_id',
		'seen',
		'active',
		'views',
		'user_id'
	];

	public function getCreatedAtAttribute($time)
	{
		$this->short_month = date('M', strtotime($time));
		$this->short_day   = date('d', strtotime($time));
		return DateFormat::when($time);
	}

	public function getUpdatedAtAttribute($time)
	{
		return DateFormat::when($time);
	}

	/**
	 * One to one relation.
	 * Get the content that belongs to this post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function content()
	{
		return $this->hasOne('App\Models\Content', 'post_id', 'post_id');
	}

	/**
	 * One to many relation.
	 * Get the user published this post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
	}

	/**
	 * One to many relation.
	 * Get all comments that belong to this post
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('App\Models\Comment', 'post_id', 'comment_id');
	}

	public function categories()
	{
		return $this->belongsToMany('App\Models\Category', 'post_category', 'post_id', 'category_id');
	}
}
