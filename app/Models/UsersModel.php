<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_login','user_password','user_token','user_refresh_token','user_token_expire','user_settings'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
	
	/**
	 * @param string $login
	 * @return array
	 * Возвращает пользователя по его логину
	 */
	public function getUserByLogin(string $login):array
	{
		return $this->where(['user_login'=>$login])->get(1)->getResultArray();
	}
	
	/**
	 * @param int $id
	 * @return array
	 * Производит пару ТОКЕН + Рефреш_токен для пользователя + создает дату окончания действия токена пользователя
	 */
	public function login(int $id):array{
		$token = password_hash($id.time(),PASSWORD_DEFAULT);
		$refresh = password_hash(time().$id,PASSWORD_DEFAULT);
		$token_expire = date('Y-m-d H:i:s',strtotime('+10 minutes'));
		$this->update($id,
			[
				'user_token'            =>  $token,
				'user_refresh_token'    =>  $refresh,
				'user_token_expire'     =>  $token_expire
			]);
		$result['token']=$token;
		$result['refresh_token']=$refresh;
		$result['token_expire']=$token_expire;
		return $result;
	}
	
	
	public function refreshToken(string $refresh): array
	{
		$user = $this->getWhere(['user_refresh_token'=>$refresh],1)->getResultArray();
		if(isset($user[0]['user_id'])){
			$token = $token = password_hash($user[0]['user_id'].time(),PASSWORD_DEFAULT);
			$refresh = password_hash(time().$user[0]['user_id'],PASSWORD_DEFAULT);
			$token_expire = date('Y-m-d H:i:s',strtotime('+10 minutes'));
			$this->update($user[0]['user_id'],
				[
					'user_token'            =>  $token,
					'user_refresh_token'    =>  $refresh,
					'user_token_expire'     =>  $token_expire
				]);
			$result['token']=$token;
			$result['refresh_token']=$refresh;
			$result['token_expire']=$token_expire;
			$result['code']=200;
			return $result;
		}
		else{
			return ['message'=>'Нет такого пользователя','code'=>404];
		}
		
	}
	
	public function getUserByToken(string $token): array
	{
		return $this->where(['user_token'=>$token])->get(1)->getResultArray();
	}
	
	/**
	 * @param int $id
	 * @return bool
	 * Меняет пароль пользователя и его текущие токены обычный + рефреш
	 */
	public function setNewPasword(int $id):bool
	{
		return true;
	}
	
	/**
	 * @param string $login
	 * @param string $password
	 * @param int $group
	 * @return bool
	 * Создает нового пользователя
	 */
	public function createUser(string $login, string $password, int $group):bool
	{
		return true;
	}
	
	/**
	 * @param int $id
	 * @return bool
	 *  Удаляет пользователя
	 */
	public function deleteUser(int $id):bool
	{
		return true;
	}
	
	/**
	 * @param int $id
	 * @param string $settings
	 * @return bool
	 * Обновляет пользовательские настройки для конкретного пользователя
	 */
	public function setUserSettings(int $id, string $settings):bool
	{
		return true;
	}
}
