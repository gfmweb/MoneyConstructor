<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
		if(!$this->session->get('is_logged_in')) {
			return view('login/login');
			}
    }
}
