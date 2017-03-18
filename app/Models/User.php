<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'users';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'user_id';

	/**
	 * One to many relation.
	 * Get all posts published this user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	protected function posts()
	{
		return $this->hasMany('App\Models\Post', 'user_id', 'user_id');
	}

	/**
	 * One to many relation.
	 * Get all comments published this user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	protected function comments()
	{
		return $this->hasMany('App\Models\Comment', 'user_id', 'user_id');
	}

	/**
	 * One to many relation.
	 * Get the role that has this user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	protected function role()
	{
		return $this->hasOne('App\Models\Role', 'role_id', 'user_id');
	}
}
