<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
	public $timestamps = false;

	protected $primaryKey = 'article_id';

	protected $fillable = [
		'text'
	];
	
	
	public function text()
	{
		$this->belongsTo('App\Article', 'article_id', 'article_id');
	}


}
