<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController as Controller;
use App\Repositories\Admin\UserRepository;

class UserController extends Controller
{
	public function __construct(UserRepository $userRepository)
	{
		$this->users = $userRepository;
	}

	public function getAll()
	{
		$users = $this->users->all();
		return response()->view('admin/user/all', ['users' => $users]);
	}
	
	public function delete(Request $request)
	{
		$this->users->destroyById($request->user_id);
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

