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


	public function store($data, $activationCode)
	{
		$this->model->email = $data->email;
		$this->model->name = $data->name;
		$this->model->password = bcrypt($data->password);
		$this->model->activationCode = $activationCode;
		
		$default_role = $this->role->select('role_id')->where('name', '=', 'user')->first();
		$this->model->role_id = $default_role->role_id;

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
		return $this->prepareUsersQuery()->get();
	}

	
	public function oneById($data)
	{
		return $this->prepareUsersQuery()->where('user_id', '=', $data->user_id)->first();
	}


	protected function prepareUsersQuery()
	{
		$query = $this->model->join('roles', 'users.role_id', '=', 'roles.role_id')
			->select('users.user_id', 'users.name', 'users.email', 'users.active', 'users.ban', 'users.seen', 'roles.name as role', 'users.updated_at');

		return $query;
	}
}

