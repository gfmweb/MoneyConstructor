<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends BaseController
{
	use ResponseTrait;
	public function __construct(){
		$this->Users = model(UsersModel::class);
		
	}
	
		
    public function errorRequest(){
		if($var = 1) {
			return $this->respond(['message' => 'Этот метод работает только с POST запросами!  принимает 2 параметра \'login\',\'password\'  В ответе можете получить response с массивом token, refresh_token, token_expire  Либо ошибки с описанием в поле message и кодом ответа'], 401);
		}
		elseif($var = 2){
			return $this->respond(['message' => 'Этот метод работает только с POST запросами!  принимает 1 параметра \'refresh\' В ответе можете получить response с массивом token, refresh_token, token_expire  Либо ошибки с описанием в поле message и кодом ответа'], 401);
		}
    }
	
	public function login()
    {
		$login  = $this->request->getVar('login');
		$password = $this->request->getVar('password');
		// Отрабатываем описание в случае пустого запроса
	    if(empty($login)||empty($password)){
			return $this->respond(['message'=>'Логин: принимает 2 параметра \'login\',\'password\'  В ответе можете получить response с массивом token, refresh_token, token_expire  Либо ошибки с описанием в поле message и кодом ответа'],401);
	    }
		$user = $this->Users->getUserByLogin($login);
		//Проверка существования пользователя
		if(isset($user[0]['user_id']))$user=$user[0];
		else return $this->respond(['message'=>'Пользователь не зарегистрирован в системе'],404);
		//Проверка пароля
	    if(password_verify($password,$user['user_password'])){
			$user = $this->Users->login($user['user_id']);
			
			return $this->respond(['response'=>['token'=>$user['token'],'refresh_token'=>$user['refresh_token'],'token_expire'=>$user['token_expire']]],200);
	    }
		else{
			return $this->respond(['message'=>'Отказано в доступе'],403);
		}
		
    }
	
	public function logout()
	{
			$user = $this->Users->getUserByToken($this->accessToken);
			if( (isset($user[0]['user_id'])) && ($this->checkToken($user[0]['user_token_expire'])) ){
			
			}
			else{
				return $this->respond(['message'=>'Токен был просрочен либо такого пользователя нет. воспользуйтесь refresh_token либо заново авторизируйтесь'],400);
			}
			
			
	}
	
	public function Auth()
	{
	
	}
	
	public function RefreshAuth()
	{
		$refresh = $this->request->getVar('refresh');
		$list = $this->request->getVar('list');
		// Пустой ключ равен команде list
		if(empty($refresh)||!empty($list)){
			return $this->respond(['message' => 'Этот метод работает только с POST запросами!  принимает 1 параметра \'refresh\' В ответе можете получить response с массивом token, refresh_token, token_expire  Либо ошибки с описанием в поле message и кодом ответа'], 401);
		}
		$result = $this->Users->refreshToken($refresh);
		return ($result['code']==200)? $this->respond(['response'=>['token'=>$result['token'],'refresh_token'=>$result['refresh_token']]],$result['code']):$this->respond(['message'=>$result['message']],$result['code']);
	}
}
