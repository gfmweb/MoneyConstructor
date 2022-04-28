<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\DataSourceModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;

class Admin extends BaseController
{
    use ResponseTrait;
	
	public function getUsers(){
		$Users = model(UsersModel::class);
		return $this->respond($Users->getUsers(),200);
	}
	
	public function updateUser(){
		$Users = model(UsersModel::class);
		if((!empty($this->request->getVar('user_id')))&&(!empty($this->request->getVar('value')))) {
			$Users->setNewPasword($this->request->getVar('user_id'), password_hash($this->request->getVar('value'),PASSWORD_DEFAULT));
		}
		return $this->respond([],200);
	}
	
	public function createUser(){
		$Users = model(UsersModel::class);
		if(!empty($this->request->getVar('newlogin'))){
			$Users->createUser($this->request->getVar('newlogin'));
		}
		return $this->respond($Users->getUsers(),200);
	}
	
	public function delUser()
	{
		$Users = model(UsersModel::class);
		if(!empty($this->request->getVar('id'))){
		return	$this->respond(['id'=>$this->request->getVar('id'),$Users->deleteUser($this->request->getVar('id'))],200);
		}
	}
	
	public function getChanels()
	{
		$DataSource = model(DataSourceModel::class);
		return $this->respond($DataSource->getAllAllowedDataSources(1),200);
	}
}
