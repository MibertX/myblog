<?php
namespace App\Repositories;

use App\Models\Content;
use App\Models\Post;
use App\Models\Comment;
use App\Repositories\CategoryRepository as Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogRepository extends BaseRepository
{
	/**
	 * The dependence on the App\Models\Content
	 *
	 * @var Content
	 */
	protected $content;

	/**
	 * The dependence on the App\Models\Comment
	 *
	 * @var Comment
	 */
	protected $comment;

	/**
	 * The dependence on App\Repositories\CategoryRepository
	 *
	 * @var category
	 */
	protected $category;

	/**
	 * Default value for this class when paginating
	 *
	 * @var int
	 */
	public $elementsPerPage = 3;

	/**
	 * BlogRepository constructor.
	 * Inject all the necessary dependencies.
	 *
	 * @param Post $post
	 * @param Comment $comment
	 * @param Category $category
	 * @param Content $content
	 */
	public function __construct(Post $post, Comment $comment, Category $category, Content $content)
	{
		$this->model = $post;
		$this->comment = $comment;
		$this->category = $category;
		$this->content = $content;
	}

	/**
	 * Get all gategories from App\Repositories\CategoryRepository
	 *
	 * @return mixed
	 */
	public function allCategories()
	{
		return $this->category->allCategories();
	}

	/**
	 * Get all posts from DB and sort them with appropriate parameters
	 *
	 * As this method uses for ordering posts in adminzone, it has necessary parameters for it.
	 * This parameters also have default values for the situation when method will be used
	 * in other parts of application (for example not in adminzone, where no need to sort in other way)
	 *
	 * @param string $ordered_column
	 * @param string $direction
	 * @return mixed
	 */
	public function allPosts($ordered_column = 'posts.created_at', $direction = 'desc')
	{
		$posts = $this->preparePostsQuery()
			->where('posts.active', '=', 1)->with('categories')
			->orderBy($ordered_column, $direction)
			->paginate($this->elementsPerPage);

		return $posts;
	}

	/**
	 * Get all the posts with the category specified in the @param $category
	 *
	 * @param $category
	 * @return mixed
	 */
	public function postsByCategory($category)
	{
		$posts = $this->preparePostsQuery()
			->with('categories')
			->join('post_category', 'posts.post_id', '=', 'post_category.post_id')
			->join('categories', 'post_category.category_id', '=', 'categories.category_id')
			->where('categories.name', '=', $category)->latest()->paginate($this->elementsPerPage);
		
		return $posts;
	}

	/**
	 * Get the post with the id specified in @param $id
	 * 
	 * @param $id
	 * @return mixed
	 */
	public function postById($id)
	{
		$post = $this->preparePostsQuery()
			->with('categories')
			->join('contents', 'posts.post_id', '=', 'contents.post_id')
			->addSelect('contents.text as content')
			->where('posts.post_id', '=', $id)->first();
		
		return $post;
	}
	
	/**
	 * Preparing the select for post. It also includes with user's name and id, who posted this post.
	 *
	 * @return mixed
	 */
	protected function preparePostsQuery()
	{
		$select = $this->model
			->select('posts.post_id', 'posts.title', 'posts.preview', 'posts.seen', 'posts.active', 'posts.views', 'posts.created_at', 'posts.updated_at')
			->join('users', 'posts.user_id', '=' , 'users.user_id')->addSelect('users.name as username', 'users.user_id');

		return $select;
	}
}

