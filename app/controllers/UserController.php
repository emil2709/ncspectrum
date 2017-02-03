<?php

class UserController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->view->render('public/home');
	}

	public function test($arg = false)
	{
		echo 'We are inside user->test <br/>';
		echo 'Optional: '.$arg.'<br/>';

		require 'app/models/User.php';
		$model = new User();
	}

	public function login()
	{
		$this->view->render('public/login');
	}
	
}