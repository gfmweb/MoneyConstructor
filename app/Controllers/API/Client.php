<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Controllers\Logger;
use App\Models\JobsModel;
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
		$Jobs = model(JobsModel::class);
		$user = $this->Users->getUserByToken($this->accessToken);
		if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			$Datasources =  model(DataSourceModel::class);
			$user = $this->Users->getUserByToken($this->accessToken);
			if(isset($user[0]['user_id'])){
				$method = $Datasources->getChanelByName($method);
				if(isset($method[0])) {
					$method = $method[0];
					$method['source_constants'] = json_decode($method['source_constants'], true);
					$method['source_methods'] = json_decode($method['source_methods']);
					
					$fields = ['chat_id' => $phone, 'text' => $text];
					$job_id = $Jobs->CreateJob($method['source_name']);
					$result = eval($method['source_methods']);
					$Parse  = new Parsresults();
					$result = $Parse->Parse($method['source_name'],$result);
					$Jobs->UpdateResults($job_id,json_encode($result,256));
					$Logger = new Logger();
					$Logger->log_job('Постановка работы и первичное исполнение','jobs',$job_id,$method['source_name'],$result);
					return $this->respond(['response' => ['called_method' => $method, 'result' => $result, 'phone' => $phone, 'text' => $text, 'params' => $params]], 200);
				}
			else{
				return $this->respond(['message_ex'=>'Метод не найден'],400);
			}
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
