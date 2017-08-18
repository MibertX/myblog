<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
	protected $role;

	public $elementsPerPage = 5;

	public function __construct(User $user, Role $role)
	{
		$this->model = $user;
		$this->role = $role;
	}

	
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


	public function allUsers($ordered_column='users.name', $direction='asc')
	{
		return $this->prepareUsersQuery()
			->orderBy($ordered_column, $direction)
			->paginate($this->elementsPerPage);
	}

	
	public function oneById($data)
	{
		return $this->prepareUsersQuery()->where('user_id', '=', $data->user_id)->first();
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	public function storeByAdmin($data)
	{
		$this->model->name = $data->name;
		$this->model->password = bcrypt($data->password);
		$this->model->role_id = $data->role_id;
		$this->model->email = $data->email;
		$this->model->active = true;

		return $this->model->save();
	}

	public function allRoles()
	{
		return $this->role->select('role_id','name')->get();
	}

	public function toogleBanUser($data)
	{
		$ban = $data->ban == 'true';
		$this->model->where('user_id', '=', $data->user_id)
			->update(['ban' => $ban]);
	}
	
	public function toogleSeenUser($data)
	{
		$seen_value = $data->seen == 'true';
		$this->model->where('user_id', '=', $data->user_id)
			->update(['seen' => $seen_value]);
	}
	
	
	protected function prepareUsersQuery()
	{
		$query = $this->model->join('roles', 'users.role_id', '=', 'roles.role_id')
			->select('users.user_id', 'users.name', 'users.email', 'users.active', 
				'users.ban', 'users.seen', 'roles.name as role');

		return $query;
	}
	
	
	public function newUsers()
	{
		return $this->model->select(DB::raw('COUNT(user_id) as counter'))
			->where('seen', '=', false)->first();
	}
}

