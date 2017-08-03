<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
	protected $blog;
	
    public function __construct(BlogRepository $blog_repository)
	{
		Session::put('active', 'main');
		$this->blog = $blog_repository;
	}

//	public function getPublish()
//	{
//		$categories = $this->blog->allCategories();
//		$view = view('article/publish', array('categories' => $categories))->render();
//
//		return (new Response($view));
//	}
	
//	public function postPublish(Request $request)
//	{
//		$this->blog->store($request->all());
//		return 'true';
//	}

	public function getAll(Request $request)
	{
		Session::forget('category');
		$categories = $this->blog->allCategories();
		$posts = $this->blog->allPosts();

		return response()->view('article/all', array('articles' => $posts, 'categories' => $categories));
	}


	public function getOne($id)
	{
		Session::forget('category');
		$categories = $this->blog->allCategories();
		$post = $this->blog->postById($id);
		$post->showFull = true;

		return response()->view('article/one', array('article' => $post, 'categories' => $categories, 'content' => $post->content));
	}


	public function getByCategories($category)
	{
		$categories = $this->blog->allCategories();
		$posts = $this->blog->postsByCategory($category);
		Session::put('category', $category);

		return response()->view('article/all', array('articles' => $posts, 'categories' => $categories));
	}
}
