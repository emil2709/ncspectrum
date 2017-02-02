<?php

class UserController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		echo 'We are in user controller <br/>';
	}

	public function test($arg = false)
	{
		echo 'We are inside user->test <br/>';
		echo 'Optional: '.$arg.'<br/>';

		require 'models/User.php';
		$model = new User();
	}
	
}