<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Index extends BaseController
{
	
	
	
    public function index()
    {
        return view('admin/index');
    }
	
	public function login()
	{
		return view('admin/login');
	}
	
	public function Auth()
	{
		$login = $this->request->getVar('login');
		$password = $this->request->getVar('password');
		$Users = model(UsersModel::class);
		$user= $Users->adminLogin($login);
		if((isset($user[0]))&&(password_verify((string)$password,$user[0]['user_password']))&&($user[0]['group_id']==1) ){
			$this->session->set('user_is_admin',true);
		}
		return $this->response->redirect('/admin');
		
		
		
	}
	
	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect('/admin/login');
	}
	
	
}
