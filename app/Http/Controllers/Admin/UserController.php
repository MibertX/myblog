<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController as Controller;

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
		$result = $this->users->destroyById($request->user_id);

		if (!$result) {
			return response()->view('partials.message_partial', ['type' => 'error', 'message' => 'post was\'n deleted']);
		}

		return response()->view('partials.message_partial', ['type' => 'ok', 'message' => 'post was deleted']);
	}
	
	
	public function toogleUserSeen(Request $request)
	{
		if ($request->ajax()) {
			$this->users->toogleSeenUser($request);
		} else {
			abort(404);
		}
	}
	
	
	public function getCreateView()
	{
		$roles = $this->users->allRoles();
		return response()->view('admin.user.create', array('roles' => $roles));
	}
	
	
	public function create(Request $request)
	{
		$this->users->storeByAdmin($request);
	}
	
	
	public function toogleBan(Request $request)
	{
		$this->users->toogleBanUser($request);
	}
}

