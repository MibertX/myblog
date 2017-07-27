<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BlogController as Controller;
use App\Repositories\Admin\BlogRepository;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
	public function __construct(BlogRepository $blog_repository)
	{
		$this->blog = $blog_repository;
	}

	public function getAll(Request $request)
	{
		$this->blog->elementsPerPage = 5;
		
		if ($request->ajax()) {
			$posts = $this->blog->allPosts($request->ordered, $request->direction);
			return response()->view('admin/post/table', array('posts' => $posts));
		}

		$posts = $this->blog->allPosts();
		return response()->view('admin/post/all', array('posts' => $posts));
	}
	
	
	public function getAllOrdered(Request $request)
	{
		$this->blog->elementsPerPage = 12;
		$posts = $this->blog->allPostOrder($request->order_column, $request->direction);
		return response()->view('admin/post/table', array('posts' => $posts));
	}
	

	public function getCreateView()
	{
		$categories = $this->blog->allCategories();
		return response()->view('admin/post/create', array('categories' => $categories));
	}


	public function postCreate(ArticleRequest $request)
	{
		$this->blog->store($request);
		return redirect()->route('adminPostsView')->with('info', 'Post created successful');
	}


	public function postDelete(Request $request)
	{
		$result = $this->blog->destroyById($request->post_id);
		if (!$result) {
			echo (view('partials.message_partial', ['type' => 'error', 'message' => 'post was\'n deleted']));
		} else {
			echo (view('partials.message_partial', ['type' => 'ok', 'message' => 'post was deleted']));
		}
//		Session::put('info', 'Post was deleted');
	}

	public function getUpdateView($id)
	{
		$post = $this->blog->postById($id);
		$categories = $this->blog->allCategories();
		return response()->view('admin.post.update', ['post' => $post, 'categories' => $categories]);
	}


	public function postUpdate(ArticleRequest $request)
	{
		try {
			$this->blog->update($request);
		} catch (\Exception $e) {
			echo 'working';die;
		}
	}


	public function tooglePostSeen(Request $request)
	{
		if ($request->ajax()) {
			$this->blog->tooglePostSeen($request);
		} else {
			abort(404);
		}
	}


	public function tooglePostActive(Request $request)
	{
		if ($request->ajax()) {
			$this->blog->tooglePostActive($request);
		} else {
			abort(404);
		}
	}
}
