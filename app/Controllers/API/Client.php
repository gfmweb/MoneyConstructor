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
	
	public function getUserMethods()
	{
		$Users = model(UsersModel::class);
		$Datasources =  model(DataSourceModel::class);
		$user = $Users->getUserByToken($this->accessToken);
		if(isset($user[0]['user_id'])){
			
			return $this->respond(['response'=>$Datasources->getAllAllowedDataSources($user[0]['user_id']),'user_id'=>$user[0]['user_id']],200);
		}
		
	}
}
