<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use App\Text;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class ArticlesController extends Controller
{
	/**
	 * Get all categories as array using a App/Category model and then
	 * show the form for creating a new article.
	 *
	 * @return response
	 */
	public function getPublish()
	{
		$categories = [];
		foreach (Category::getAllCategories() as $item) {
			$categories[$item->category_id] = $item->name;
		}

		$view = view('article/publish', array('categories' => $categories))->render();

		return (new Response($view));
	}

	
	/**
	 * Create the new article, save the it's text into .txt file and save it in DB after successfully validation
	 *
	 * @return string
	 */
	public function postPublish(Request $request)
	{
		$data = $request->all();

		foreach ($data as $key=>$item) {
			if ($key == '_token' || $key == 'categories') continue;

			$data[$key] = trim($item);
		}

		$validation = Validator::make($data, Article::getValidationRules());

		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		}

		$article = new Article();
		$article->saveInDataBase($data);

		return 'Добавлена новость, id: ' . $article->article_id;
	}


	public function getAll()
	{
		$articles = Article::simplepaginate(3);

		foreach ($articles as $article) {

			if ($article->created_at == $article->updated_at) {
				$article->author = 'Добавил ' . /*$article->author;*/ 'Mibert';
				$article->date   = $article->created_at;
			}else {
				$article->author = 'Изменил ' . /*$article->author;*/ 'Mibert';
				$article->date   = $article->updated_at;
			}

		    $article->text = Article::find(15)->text->text;
		}



		$categories = Category::getAllCategories();
//		return (new Response('article/all', array('news' => $news, 'categories' => $categories)));
		return response()->view('article/all', array('articles' => $articles, 'categories' => $categories));
//		return view('news/all', array('news' => $news, 'categories' => $categories));
	}
}
