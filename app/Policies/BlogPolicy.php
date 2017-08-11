<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function updatePost (User $user)
    {
        $userIsAdmin = $user->role->name == 'admin';
		$userIsRedactor = $user->role->name == 'redactor';

        return $userIsAdmin || $userIsRedactor;
    }

    public function createPost(User $user)
    {
		$userIsAdmin = $user->role->name == 'admin';
		$userIsRedactor = $user->role->name == 'redactor';
        return $userIsAdmin || $userIsRedactor;
    }
	
	public function deletePost(User $user)
	{
		return $user->role->name == 'admin';
	}
	
	public function tooglePostSeen(User $user)
	{
		return $user->role->name == 'admin';
	}
	
	public function tooglePostActive(User $user)
	{
		$userIsAdmin = $user->role->name == 'admin';
		$userIsRedactor = $user->role->name == 'redactor';
		
		return $userIsAdmin || $userIsRedactor;
	}
	
	public function dashboard(User $user)
	{
		return $user->role->name != 'user';
	}
	
	public function createCategory(User $user)
	{
		$userIsAdmin = $user->role->name == 'admin';
		$userIsRedactor = $user->role->name == 'redactor';
		return $userIsAdmin || $userIsRedactor;
	}
	
	public function deleteCategory(User $user)
	{
		return $user->role->name == 'admin';
	}
	
	public function updateCategory(User $user)
	{
		$userIsAdmin = $user->role->name == 'admin';
		$userIsRedactor = $user->role->name == 'redactor';
		return $userIsAdmin || $userIsRedactor;
	}
	
	public function toogleCategorySeen(User $user)
	{
		return $user->role->name == 'admin';
	}
	
	public function toogleCategoryActive(User $user)
	{
		return $user->role->name == 'admin';
	}
	
	
	
}
