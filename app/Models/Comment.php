<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'comments';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'comment_id';

	/**
	 * One to many relation.
	 * Get the post, that has this comment.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post()
	{
		return $this->belongsTo('App\Models\Post', 'post_id', 'comment_id');
	}

	/**
	 * One to many re;ation.
	 * Get the user published this comment.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
	}
}
