<?php
namespace App\Repositories\Admin;

use App\Repositories\BlogRepository as BaseRepository;
use App\Repositories\Admin\CategoryRepository as Category;
use App\Models\Content;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class BlogRepository extends BaseRepository
{
	/**
	 * BlogRepository constructor.
	 *
	 * This class has the same constructor as its parent, excapt the value of @param $category.
	 * (using 'Admin\CategoryRepository' except 'CategoryRepository')
	 *
	 * @param Post $post
	 * @param Comment $comment
	 * @param Category $category
	 * @param Content $content
	 */
	public function __construct(Post $post, Comment $comment, Category $category, Content $content)
	{
		parent::__construct($post, $comment, $category, $content);
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
	 */
	public function store($data)
	{
		try {
			DB::beginTransaction();
			$this->savePost($data);
			$this->saveCategories($data);
			$this->saveContent($data);
			DB::commit();
		}
		catch (\Exception $exception) {
			DB::rollBack();
			abort(503);
		};
	}

	/**
	 * Update the post
	 *
	 * @param $data
	 * @throws \Exception
	 */
	public function update($data)
	{
		try {
			$this->model = $this->postById($data->post_id);

			DB::beginTransaction();
			$this->updatePost($data);
			$this->updateContent($data);
			$this->updateCategories($data);
			DB::commit();
		} catch (\Exception $exception) {
			DB::rollBack();
			throw new \Exception($exception);
		};
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
}

