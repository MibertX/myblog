<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'roles';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'role_id';


	public $fillable = [
		'role_id',
		'name'
	];


	/**
	 * One to many relation.
	 * Get all users that has this role.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	protected function user()
	{
		return $this->belongsToMany('App\Models\User', 'role_id', 'role_id');
	}
}
