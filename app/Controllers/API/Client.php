<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use App\Models\DataSourceModel;
class Client extends BaseController
{
	use ResponseTrait;
    public function index()
    {
        //
    }
	public function __construct(){
		$this->Users = model(UsersModel::class);
		
	}
	
	public function getUserMethods()
	{
		$user = $this->Users->getUserByToken($this->accessToken);
		
		if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			$Datasources =  model(DataSourceModel::class);
			$user = $this->Users->getUserByToken($this->accessToken);
			if(isset($user[0]['user_id'])){
				return $this->respond(['response'=>$Datasources->getAllAllowedDataSources($user[0]['user_id'])],200);
			}
		}
		else{
			return $this->respond(['message_ex'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
		}
	}
	
	public function run()
	{
		$method = $this->request->getVar('method');
		$phone = $this->request->getVar('phone');
		$text = $this->request->getVar('text');
		$params = $this->request->getVar('params');
		
		$user = $this->Users->getUserByToken($this->accessToken);
		
		if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			$Datasources =  model(DataSourceModel::class);
			$user = $this->Users->getUserByToken($this->accessToken);
			if(isset($user[0]['user_id'])){
				
				return $this->respond(['response'=>['called_method'=>$method,'phone'=>$phone,'text'=>$text,'params'=>$params]],200);
			}
		}
		else{
			return $this->respond(['message_ex'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
		}
	}
}
