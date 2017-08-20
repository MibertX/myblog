<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //Blog rules
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


    //Category rules
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


    //Comment rules
    public function deleteComment(User $user)
    {
        return $user->role->name == 'admin';
    }

    public function toogleCommentSeen(User $user)
    {
        return $user->role->name == 'admin';
    }

    public function toogleCommentValid(User $user)
    {
        $userIsAdmin = $user->role->name == 'admin';
        $userIsModerator = $user->role->name == 'moderator';
        return $userIsAdmin || $userIsModerator;
    }


    //User rules
    public function deleteUser($user, $deleted_user)
    {
        if ($user->user_id == $deleted_user->user_id) {
            return false;
        }

        if ($deleted_user->role == 'admin') {
            return false;
        }

        return $user->role->name == 'admin';
    }

    public function toogleUserSeen(User $user)
    {
        return $user->role->name == 'admin';
    }

    public function createUser(User $user)
    {
        return $user->role->name == 'admin';
    }

    public function toogleUserBan(User $user, $banned_user)
    {
        if ($banned_user->role == 'admin') {
            return false;
        }

        if ($banned_user->user_id == $user->user_id) {
            return false;
        }

        return $user->role->name == 'admin';
    }
}
