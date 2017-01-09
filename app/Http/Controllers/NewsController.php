<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\News;

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
		$data['title'] = $_POST['title'];
		$data['categories'] = News::categoriesToStr(Input::all());
		$data['author'] = 'Mibert';
		$data['text'] = $_POST['text'];

		$validation = Validator::make($data, News::getValidationRules());
		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		}

		$article = News::create($data);
		return 'Добавлена новость, id: ' . $article->id;

	}
}
