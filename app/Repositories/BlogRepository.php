<?php
namespace App\Repositories;

use App\Models\Content;
use App\Models\Post;
use App\Repositories\CategoryRepository as Category;
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
	 * The dependence on the App\Repositories\CommentRepository
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
	 * The dependence on App\Repositories\UserRepository
	 * 
	 * @var user
	 */
	protected $user;

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
	 * @param CommentRepository $comment_repository
	 * @param Category $category
	 * @param Content $content
	 * @param UserRepository $user_repository
	 */
	public function __construct(Post $post, CommentRepository $comment_repository, 
								Category $category, Content $content, UserRepository $user_repository)
	{
		$this->model = $post;
		$this->comment = $comment_repository;
		$this->category = $category;
		$this->content = $content;
		$this->user = $user_repository;
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
	 * Toogle the post seen value (true or false)
	 *
	 * @param $data
	 */
	public function tooglePostSeen($data)
	{
		$seen = $data->seen == 'true';
		$this->model->where('post_id', '=', $data->post_id)->update(['seen' => $seen]);
	}

	/**
	 * Toogle the post active value (true or false)
	 *
	 * @param $data
	 */
	public function tooglePostActive($data)
	{
		$active = $data->active == 'true';
		$this->model->where('post_id', '=', $data->post_id)->update(['active' => $active]);
	}

	/**
	 * Store the post into DB.
	 *
	 * Saving the article affects several tables.
	 * So, saving to each table has its own method,
	 * and this method performs them together in a transaction.
	 *
	 * @param $data
	 * @return bool
	 */
	public function store($data)
	{
		try {
			DB::beginTransaction();
			$this->savePost($data);
			$this->saveCategories($data);
			$this->saveContent($data);
			DB::commit();
			return true;
		}
		catch (\Exception $exception) {
			DB::rollBack();
			return false;
		};
	}

	/**
	 * Update the post
	 *
	 * @param $data
	 * @return bool
	 */
	public function update($data)
	{
		try {
			$this->model = $this->postById($data->post_id);

			DB::beginTransaction();
			$this->updatePost($data);
			$this->updateContent($data);
			$this->updateCategories($data);
			$this->model->update(['seen' => false]);
			DB::commit();
			$result = true;
		} catch (\Exception $exception) {
			DB::rollBack();
			$result = false;
		};

		return $result;
	}

	public function newPosts()
	{
		return $this->model->select(DB::raw('COUNT(post_id) as counter'))
			->where('seen', '=', false)->first();
	}
	
	public function newCategories()
	{
		return $this->category->newCategories();
	}
	
	public function newUsers()
	{
		return $this->user->newUsers();
	}

	/**
	 * Saving data of the post in table 'posts'.
	 *
	 * @param $data
	 */
	protected function savePost($data)
	{
		$this->model->title = $data->title;
		$this->model->user_id = 1; // доделать чтобы ставился айди текущего залогиненого пользователя
		$this->model->preview = $data->preview;
		$this->model->save();
	}

	/**
	 * Update data of the post in table 'posts'.
	 *
	 * No need to update the same data, so, before update, data will be
	 * checked for the difference
	 *
	 * @param $data
	 */
	protected function updatePost($data)
	{
		if($this->model->title != $data->title || $this->model->preview != $data->preview) {
			$this->model->update(['title' => $data->title, 'preview' => $data->preview]);
		}
	}

	/**
	 * Save data of the post in table 'contents'.
	 *
	 * @param $data
	 */
	protected function saveContent($data)
	{
		$this->content->text = $data->text;
		$this->content->post_id = $this->model->post_id;
		$this->content->save();
	}

	/**
	 * Update data of the post in table 'contents'.
	 *
	 * No need to update the same data, so, before update, data will be
	 * checked for the difference
	 *
	 * @param $data
	 */
	protected function updateContent($data)
	{
		if($this->model->content != $data->text)
			$this->content->where('post_id', '=', $data->post_id)->update(['text' => $data->text]);
	}

	/**
	 * Saving data of the post in pivot table 'post_category'.
	 *
	 * @param $data
	 */
	protected function saveCategories($data)
	{
		$this->model->categories()->attach($data->categories);
		$this->model->save();
	}

	/**
	 * Update data of the post in pivot table 'post_category'.
	 *
	 * No need to update the same data, so, before update, data will be
	 * checked for the difference
	 *
	 * @param $data
	 */
	protected function updateCategories($data)
	{
		if ($this->model->categories != $data->categories) {
			$this->model->categories()->sync($data->categories);
		}
	}

	/**
	 * Preparing the select for post. It also includes with user's name and id, who posted this post.
	 *
	 * @return mixed
	 */
	protected function preparePostsQuery()
	{
		$select = $this->model
			->select('posts.post_id', 'posts.title', 'posts.preview', 'posts.seen', 'posts.active',
				'posts.views', 'posts.created_at', 'posts.updated_at', 'posts.user_id')
			->join('users', 'posts.user_id', '=' , 'users.user_id')
			->addSelect('users.name as username', 'users.user_id');

		return $select;
	}
}

