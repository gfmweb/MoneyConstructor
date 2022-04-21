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
	
	/**
	 * Вычленение Токена из заголовков запроса
	 * @return string
	 */
	private function getToken()
	{
		$token = $this->request->getHeaderLine('Authorization');
		if(!empty($token)) {
			if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
				$token = $matches[1];
				$token = trim(str_replace('Bearer','',$token));
			}
		}
		return $token;
	}
	
	/**
	 * @param array $user
	 * @return void
	 * Проверка свежести токена
	 */
	private function checkToken(array $user): bool
	{
		return (time($user['user_token_expire']) >= time())?false:true;
	}
	
    public function errorRequest(){
		return $this->respond(['message'=>'Этот метод работает только с POST запросами!  принимает 2 параметра \'login\',\'password\'  В ответе можете получить response с массивом token, refresh_token, token_expire  Либо ошибки с описанием в поле message и кодом ответа'],401);
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
			return $this->respond(['response'=>$this->Users->login($user['user_id'])],200);
	    }
		else{
			return $this->respond(['message'=>'Отказано в доступе'],403);
		}
		
    }
	
	public function logout()
	{
			$user = $this->Users->getUserByToken($this->getToken());
			if(!isset($user[0]['user_id']))
			return $this->respond(['token'=>$this->getToken(), 'user'=>$user],200);
	}
	
	public function Auth()
	{
	
	}
	
	public function RefreshAuth()
	{
	
	}
}
