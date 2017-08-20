<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController as Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
	public function allUsers(Request $request)
	{
		if ($request->ajax()) {
			$users = $this->users->allUsers($request->ordered_column, $request->direction);
			return response()->view('admin/user/table', ['users' => $users]);
		}
		
		$users = $this->users->allUsers();
		return response()->view('admin/user/all', ['users' => $users]);
	}
	
	
	public function deleteUser(Request $request)
	{
		$deleted_user = $this->users->oneById($request);

		if (Gate::denies('deleteUser', $deleted_user)) {
			abort(403);
		}

		$result = $this->users->destroyById($request->user_id);

		if (!$result) {
			return response()->view('partials.message_partial', ['type' => 'error', 'message' => 'post was\'n deleted']);
		}

		return response()->view('partials.message_partial', ['type' => 'ok', 'message' => 'post was deleted']);
	}
	
	
	public function toogleUserSeen(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		if (Gate::denies('toogleUserSeen', $request->user())) {
			abort(403);
		}

		$this->users->toogleSeenUser($request);
	}
	
	
	public function createUserView(Request $request)
	{
		if (Gate::denies('createUser', $request->user())) {
			abort(403);
		}

		$roles = $this->users->allRoles();
		return response()->view('admin.user.create', array('roles' => $roles));
	}
	
	
	public function createUser(Request $request)
	{
		$this->users->storeByAdmin($request);
	}
	
	
	public function toogleUserBan(Request $request)
	{
		if (!$request->ajax()) {
			abort(404);
		}

		$banned_user = $this->users->oneById($request);

		if (Gate::denies('toogleUserBan', $banned_user)) {
			abort(403);
		}

		$this->users->toogleUserBan($request);
	}
}

