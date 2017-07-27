<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
//use App\Http\Requests\Request;
use App\Http\Requests\RegisterRequest;
use App\Repositories\BlogRepository;
use App\Text;
use Illuminate\Http\Request;
//use Illuminate\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleRequest;



class ArticlesController extends Controller
{
	protected $article_gestion;

	public function __construct(Article $article)
	{
		$this->middleware('guest');
		$this->article_gestion = $article;
	}

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

//		foreach ($data as $key=>$item) {
//			if ($key == '_token' || $key == 'categories') continue;
//
//			$data[$key] = trim($item);
//		}

//		$validation = Validator::make($data, Article::getValidationRules());
//
//		if ($validation->fails()) {
//			return Redirect::back()->withErrors($validation)->withInput();
//		}
		
//		$article = new Article();
		$this->article_gestion->saveInDataBase($data);

//		return 'Добавлена новость, id: ' . $this->article_gestion->article_id;
		return 'Добавлена новость, id: ';
	}


	public function getAll()
	{
//		$test = new Article();
//		$test->testall();

//		$articles = Article::simplepaginate(3);

		$test = new Article();
		$articles = $test->testall();

		foreach ($articles as $article) {

				if ($article->created_at == $article->updated_at) {
//				$article->author = 'Добавил ' . /*$article->author;*/ 'Mibert';
					$article->author = 'Добавил ' . $article->author->login;
					$article->date   = $article->created_at;
				}else {
					$article->author = 'Изменил ' . /*$article->author;*/ 'Mibert';
					$article->date   = $article->updated_at;
				}


//				$article->cate = ($article->categories->find($article->article_id)->name);
//			foreach ($article->categories as $category) {
//				var_dump($category->name);
//			}
//			die;
//				$article->text = $article->text->text;

		}



		$categories = Category::getAllCategories();
//		return (new Response('article/all', array('news' => $news, 'categories' => $categories)));
		return response()->view('article/all', array('articles' => $articles, 'categories' => $categories));
//		return view('news/all', array('news' => $news, 'categories' => $categories));
	}
	
	
	
	public function test(BlogRepository $blog) 
	{
		$blog->allCategories();
	}
}
