<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	 * One to one relation.
	 * Get the content that belongs to this post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	protected function content()
	{
		return $this->hasOne('App\Models\Content', 'content_id', 'content_id');
	}

	/**
	 * One to many relation.
	 * Get the user published this post
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	protected function author()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
	}

	/**
	 * One to many relation.
	 * Get all comments that belong to this post
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	protected function comments()
	{
		return $this->hasMany('App\Models\Comment', 'post_id', 'comment_id');
	}
}
