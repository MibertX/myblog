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
}
