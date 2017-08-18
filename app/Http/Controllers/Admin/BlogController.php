<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BlogController as Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
	/**
	 * Get all posts.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function allPosts(Request $request)
	{
		$this->blog->elementsPerPage = 5;
		
		if ($request->ajax()) {
			$posts = $this->blog->allPosts($request->ordered, $request->direction);
			return response()->view('admin/post/table', array('posts' => $posts));
		}

		$posts = $this->blog->allPosts();
		return response()->view('admin/post/all', array('posts' => $posts));
	}

	public function newPosts()
	{
		$posts = $this->blog->newPosts();
		return response()->view('admin.dashboard.posts', array('posts' => $posts));
	}
	
	/**
	 * Show the form for creating post.
	 *
	 * @param $request
	 * @return \Illuminate\Http\Response
	 */
	public function createPostView(Request $request)
	{
		if (Gate::denies('createPost', $request->user())) {
			return redirect()->back()->with('error', 'no permission');
		}

		$categories = $this->blog->allCategories();
		return response()->view('admin/post/create', array('categories' => $categories));
	}

	/**
	 * Create post.
	 *
	 * @param ArticleRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function createPost(ArticleRequest $request)
	{
		$result = $this->blog->store($request);
		
		if (!$result) {
			return redirect()->back()->with('error', 'Server error. post was not created');
		}
		
		return redirect()->route('adminPostsView')->with('info', 'Post created successful');
	}

	/**
	 * Get the form for updating selected post.
	 *
	 * @param $id
	 * @param $request
	 * @return \Illuminate\Http\Response
	 */
	public function updatePostView($id, Request $request)
	{
		$post = $this->blog->postById($id);
		if (Gate::denies('updatePost', $request->user()))  {
			return redirect()->back()->with('error', 'no permission');
		}
		
		$categories = $this->blog->allCategories();
		return response()->view('admin.post.update', ['post' => $post, 'categories' => $categories]);
	}

	/**
	 * Update the selected post.
	 *
	 * @param ArticleRequest $request
	 * @return redirect
	 */
	public function updatePost(ArticleRequest $request)
	{
		$result = $this->blog->update($request);
		
		if(!$result) {
			return redirect()->back()->with('error', 'server error. post was not updated');
		}
		
		return redirect()->route('adminPostsView')->with('ok', 'post was updated');
	}

	/**
	 * Delete post.
	 *
	 * @param Request $request
	 * @return response
	 */
	public function deletePost(Request $request)
	{
		if (Gate::denies('deletePost', $request->user())) {
			return redirect()->back()->with('error', 'no permission');
		}

		$result = $this->blog->destroyById($request->post_id);

		if (!$result) {
			return response()->view('partials.message_partial', ['type' => 'error', 'message' => 'post was\'n deleted']);
		}

		return response()->view('partials.message_partial', ['type' => 'ok', 'message' => 'post was deleted']);
	}
	
	/**
	 * Toogle seen (it can be true or false) of the post.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function tooglePostSeen(Request $request)
	{
		if (Gate::denies('tooglePostSeen', $request->user())) {
			return redirect()->back()->with('error', 'no permission');
		}

		if ($request->ajax()) {
			$this->blog->tooglePostSeen($request);
		} else {
			abort(404);
		}
	}

	/**
	 * Toogle active(it can be true or false) of the post.
	 *
	 * @param Request $request
	 */
	public function tooglePostActive(Request $request)
	{
		if ($request->ajax()) {
			if (Gate::denies('tooglePostActive', $request->user())) {
				$this->blog->tooglePostActive($request);
			}
		} else {
			abort(404);
		}
	}

	public function dashboard(Request $request)
	{
		if (Gate::denies('dashboard', $request->user())) {
			return redirect()->back()->with('error', 'no permision');
		}

		$new_users = $this->blog->newUsers();
		$new_categories = $this->blog->newCategories();
		$new_posts = $this->blog->newPosts();
		$new_comments = $this->comment->newComments();
		
		return view('admin.dashboard.menu', array(
			'new_users' => $new_users->counter,
			'new_categories' => $new_categories->counter,
			'new_posts' => $new_posts->counter,
			'new_comments' => $new_comments->counter));
	}
}

