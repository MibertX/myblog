<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController as Controller;

class UserController extends Controller
{
	public function getAll()
	{
		$users = $this->users->all();
		return response()->view('admin/user/all', ['users' => $users]);
	}
}
