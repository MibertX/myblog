<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	/**
	 * The Dependency on App\Repositories\CommentRepository
	 *
	 * @var CommentRepository
	 */
	protected $comment;

	/**
	 * Inject all the necessary dependencies in constructor.
	 *
	 * @param CommentRepository $comment_repository
	 */
    public function __construct(CommentRepository $comment_repository)
	{
		$this->comment = $comment_repository;
	}

	/**
	 * Get all comments to show them in comments section in adminzone.
	 *
	 * There is an ajax pagination, so when request is ajax -
	 * return only comments view instead of whole page
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function commentsForAdmin(Request $request)
	{
		$comments = $this->comment->allCommentsForAdmin();

		if (!$request->ajax()) {
			return response()->view('admin/comments/all', array('comments' => $comments));
		}

		return response()->view('admin/comments/preview', array('comments' => $comments));
	}

	/**
	 * Toogle comment seen value (true or false).
	 *
	 * This request can be only ajax. If not - show 404 page.
	 *
	 * @param Request $request
	 */
	public function toogleCommentSeen(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}
		
		if (Gate::denies('toogleCommentSeen', $request->user())) {
			abort(403);
		}
		
		$this->comment->toogleCommentSeen($request);
	}

	/**
	 * Toogle comment valid value (true or false)
	 *
	 * This request can be only ajax. If not - show 404 page.
	 *
	 * @param Request $request
	 */
	public function toogleCommentValid(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		if (Gate::denies('toogleCommentValid', $request->user())) {
			abort(403);
		}
		
		$this->comment->toogleCommentValid($request);
	}


	/**
	 * Delete comment and show the popup message of the result.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function deleteComment(Request $request)
	{
		if(Gate::denies('deleteComment', $request->user())) {
			abort(403);
		}

		$result = $this->comment->destroyById($request->comment_id);

		if (!$result) {
			return response()->view('partials.message_partial', ['type' => 'error', 'message' => 'comment was\'n deleted']);
		}
		
		return response()->view('partials.message_partial', ['type' => 'ok', 'message' => 'comment was deleted']);
	}
}
