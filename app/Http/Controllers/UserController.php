<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $users;

	public function __construct(UserRepository $userRepository)
	{
		$this->users = $userRepository;
	}
	
	public function getOne(Request $request)
	{
		$user = $this->users->oneById($request);
		return response()->view('admin/user/one', array('user' => $user));
	}
}

