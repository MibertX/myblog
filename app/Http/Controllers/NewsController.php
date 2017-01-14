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

	/**
	 * Create the new article, save the it's text into .txt file and save it in DB after successfully validation
	 *
	 * @return string
	 */
	public function postAdd()
	{
		//create a data array of user input to validate it
		$validation_array['title']      = trim($_POST['title']);
		$validation_array['categories'] = News::categoriesToStr(Input::all()); // array of categories into a string
		$validation_array['author']     = 'Mibert';
		$validation_array['text']       = trim($_POST['text']);
		$validation = Validator::make($validation_array, News::getValidationRules());
		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		}
		
		//create a new article (object) using successfully validated data
		$article = new News();
		$article->title      = $validation_array['title'];
		$article->author     = 'Mibert';
		$article->text       = $article->saveInTxtFile($validation_array['text']); 
		$article->categories = $validation_array['categories'];

		//and save it into DB
		$article->save();
		return 'Добавлена новость, id: ' . $article->id . $article->created_at;
	}
}
