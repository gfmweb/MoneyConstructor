<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Index extends BaseController
{
	
	public function __construct(){
		if(!$this->session->get('user_role')||($this->session->get('user_role')!=='admin')){
			return $this->redirect('/');
		}
	}
	
    public function index()
    {
    
    }
}
