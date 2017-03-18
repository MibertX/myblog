<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'contents';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'content_id';

	/**
	 * One to one relation.
	 * Get the post that has this content.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post()
	{
		return $this->belongsTo('App\Models\Post', 'content_id', 'content_id');
	}
	
}
