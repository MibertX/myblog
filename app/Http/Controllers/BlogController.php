<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\CommentRepository;

class BlogController extends Controller
{
	protected $comment;
	
	/**
	 * Dependency, which will be inject in constructor
	 *
	 * @var BlogRepository
	 */
	protected $blog;

	/**
	 * BlogController constructor.
	 *
	 * @param BlogRepository $blog_repository
	 * @param CommentRepository $comment_repository
	 */
    public function __construct(BlogRepository $blog_repository, CommentRepository $comment_repository)
	{
		$this->blog = $blog_repository;
		$this->comment = $comment_repository;
	}

	/**
	 * The main page of blog
	 *
	 * Get all posts with pagination.
	 * Also get all categories separately, that will be used as filter.
	 * Each category is a link, and by clicking on it the posts
	 * of the corresponding category will be shown instead of all posts.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function allPosts(Request $request)
	{
		$categories = $this->blog->allCategories();
		$posts = $this->blog->allPosts();
		Session::forget('category');

		return response()->view('article/all', array('articles' => $posts, 'categories' => $categories));
	}

	/**
	 * Get one post.
	 *
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function onePost($id)
	{
		$categories = $this->blog->allCategories();
		$post = $this->blog->postById($id);
		$post->showFull = true;
		$comments = $this->comment->commentsByPostId($id);

		return response()->view('article/one', array('article' => $post, 'categories' => $categories, 'comments' => $comments));
	}

	/**
	 * Get all posts that have selected categories
	 * 
	 * @param $category
	 * @return \Illuminate\Http\Response
	 */
	public function postsByCategory($category)
	{
		$categories = $this->blog->allCategories();
		$posts = $this->blog->postsByCategory($category);
		Session::put('category', $category);

		return response()->view('article/all', array('articles' => $posts, 'categories' => $categories));
	}
}

