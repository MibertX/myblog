<?php
namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository
{
	/**
	 * Inject all the necessary dependencies in constructor.
	 *
	 * @param Comment $comment
	 */
	public function __construct(Comment $comment)
	{
		$this->model = $comment;
	}

	/**
	 * Get all comments.
	 *
	 * @return mixed
	 */
	public function allCommentsForAdmin()
	{
		$comments = $this->prepareCommentsQuery()
			->join('users', 'users.user_id', '=', 'comments.user_id')
			->join('posts', 'posts.post_id', '=', 'comments.post_id')
			->addSelect('users.name as username', 'posts.title as title')
			->paginate($this->elementsPerPage);

		return $comments;
	}

	/**
	 * Toogle the comment seen value (true or false).
	 *
	 * @param $data
	 */
	public function toogleCommentSeen($data) 
	{
		$seen_value = ($data->seen == 'true');

		return $this->model
			->where('comment_id', '=', $data->comment_id)
			->update(['seen' => $seen_value]);
	}

	/**
	 * Toogle the comment valid value (true or false).
	 *
	 * @param $data
	 */
	public function toogleCommentValid($data)
	{
		$valid_value = ($data->valid == 'true');

		return $this->model
			->where('comment_id', '=', $data->comment_id)
			->update(['valid' => $valid_value]);
	}

	/**
	 * Count all new (where seen == false) comments.
	 *
	 * @return mixed
	 */
	public function newComments()
	{
		$counter = $this->model
			->select(DB::raw('COUNT(comments.comment_id) as counter'))
			->where('comments.seen', '=', false)->first();

		return $counter;
	}

	/**
	 * Get all comments that belong to the post with @param $post_id
	 *
	 * @param $post_id
	 * @return mixed
	 */
	public function commentsByPostId($post_id)
	{
		$commnets = $this->prepareCommentsQuery()
			->where('post_id', '=', $post_id)
			->join('users', 'users.user_id', '=', 'comments.user_id')
			->join('roles', 'roles.role_id', '=', 'users.role_id')
			->addSelect('users.name as username', 'roles.name as role')->get();
		
		return $commnets;
	}

	/**
	 * Prepare the select for usual queries to comment table.
	 *
	 * @return mixed
	 */
	protected function prepareCommentsQuery()
	{
		$query = $this->model->select('comments.comment_id', 'comments.text', 'comments.seen',
			'comments.valid', 'comments.user_id', 'comments.post_id', 'comments.created_at');

		return $query;
	}
}