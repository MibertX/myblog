<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 30.07.2017
 * Time: 21:26
 */

namespace App\Repositories\Admin;
use App\Repositories\UserRepository as BaseRepository;


class UserRepository extends BaseRepository
{
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
}

