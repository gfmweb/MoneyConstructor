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
				$method = $Datasources->getChanelByName($method);
				$method = $method[0];
				$method['source_setup'] = json_decode($method['source_setup'],true);
				$method['source_methods'] = json_decode($method['source_methods']);
				$TOKEN='5383682458:AAExH44FeKgrkATv0rq7NeMMM7nwnESfDDU';
				$fields = [
					'chat_id'=>$phone,
					'text'=>$text
				];
				$result = eval($method['source_methods']);
				return $this->respond(['response'=>['called_method'=>$method,'result'=>$result,'phone'=>$phone,'text'=>$text,'params'=>$params]],200);
			}
		}
		else{
			return $this->respond(['message_ex'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
		}
	}
	
	public function report()
	{
		$id = $this->request->getVar('id');
		$user = $this->Users->getUserByToken($this->accessToken);
		if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			$Datasources =  model(DataSourceModel::class);
			$user = $this->Users->getUserByToken($this->accessToken);
			if(isset($user[0]['user_id'])){
				return $this->respond(['response'=>['report'=>'Статус','requested_id'=>$id]],200);
			}
		}
		else{
			return $this->respond(['message_ex'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
		}
	}
	
	public function reportList()
	{
		$start = $this->request->getVar('start');
		$finish = $this->request->getVar('finish');
		if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			$Datasources =  model(DataSourceModel::class);
			$user = $this->Users->getUserByToken($this->accessToken);
			if(isset($user[0]['user_id'])){
				return $this->respond(['response'=>['requests'=>'массив запросов со статусами','requested_start'=>$start,'requested_finish'=>$finish]],200);
			}
		}
		else{
			return $this->respond(['message_ex'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
		}
	}
}
