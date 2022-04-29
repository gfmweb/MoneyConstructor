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
	
	public function newChanel()
	{
		$name = $this->request->getVar('name');
		$code = $this->request->getVar('code');
		if((!empty($name))&&(!empty($code))){
			$DataSource = model(DataSourceModel::class);
			return $this->respond($DataSource->newChanel($name,$code),200);
		}
		return $this->respond([],400);
	}
	
	public function editChanel()
	{
		$id = (int)$this->request->getVar('id');
		$name = $this->request->getVar('name');
		$code = json_decode($this->request->getVar('code'));
		
		if((!empty($name))&&(!empty($code))&&(!empty($id))){
			$DataSource = model(DataSourceModel::class);
			return $this->respond(['model'=>$DataSource->editChanel($id,$name,$code)],200);
		}
		return $this->respond([],400);
	}
	
	public function getChanel()
	{
		$id = $this->request->getVar('id');
		if(!empty($id)){
			$DataSource = model(DataSourceModel::class);
			$data = $DataSource->getChanelByID($id);
			$data = $data[0];
			$data['source_methods']=htmlspecialchars_decode(json_decode($data['source_methods']));
			return $this->respond($data,200);
		}
			return $this->respond([],400);
	}
	
	public function delChanel()
	{
		$id= $this->request->getVar('id');
		if(!empty($id)){
			$DataSource = model(DataSourceModel::class);
			return $DataSource->delChanel($id);
		}
	}
}
