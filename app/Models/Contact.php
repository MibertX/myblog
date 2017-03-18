<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	/**
	 * Model's database table
	 *
	 * @var string
	 */
    protected $table = 'contacts';

	/**
	 * Table primary_key
	 *
	 * @var string
	 */
	protected $primaryKey = 'contact_id';
}
