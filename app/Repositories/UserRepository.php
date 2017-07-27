<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\Role;

class UserRepository extends BaseRepository
{
	protected $role;

	public function __construct(User $user, Role $role)
	{
		$this->model = $user;
		$this->role = $role;
	}

	
//	private function save($user, $inputs)
//	{
//		$user->email = $inputs['email'];
//		$user->name = $inputs['name'];
//
//		$user_role = $this->role->select('role_id')->where('name', '=', 'user')->first();
//		$user->role_id = $user_role->role_id;
//
//		$user->save();
//	}

	public function store($inputs, $activationCode)
	{
		$user = new $this->model;
		$this->model->email = $inputs['email'];
		$this->model->name = $inputs['name'];
		$user_role = $this->role->select('role_id')->where('name', '=', 'user')->first();
		$this->model->role_id = $user_role->role_id;
		$this->model->password = bcrypt($inputs['password']);
		$this->model->activationCode = $activationCode;
//		$this->save($user, $inputs);
		$this->model->save();
		return $this->model;
	}
	
	public function confirm($activationCode)
	{
		$user = $this->model->where('activationCode', '=', $activationCode)->FirstOrFail();
		$user->active = true;
		$user->activationCode = null;
		$user->save();
	}
	
	public function all()
	{
		$users = $this->model->join('roles', 'users.role_id', '=', 'roles.role_id')
			->select('users.user_id', 'users.name', 'roles.name as role')->get();
		return $users;
	}
}