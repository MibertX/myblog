<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
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

	protected static $globalScopes = [
		'user_id'
	];

	public $fillable = [
		'user_id',
		'name',
		'email',
		'role_id',
		'seen',
		'active',
		'ban',
		'updated_at'
	];

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
		return $this->hasOne('App\Models\Role', 'role_id', 'role_id');
	}
}
