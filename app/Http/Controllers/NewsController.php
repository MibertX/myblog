<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
	/**
	 * Show the form for creating a new article
	 *
	 * @return Response
	 */
	public function getAdd()
	{
		return view('news/add');
	}


	public function postAdd()
	{
		return 'hello';
	}
}
