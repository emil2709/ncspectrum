<?php

class User extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		echo 'We are in user controller <br/>';
	}

	public function test($arg = false)
	{
		echo 'We are inside user-other <br/>';
		echo 'Optional: '.$arg.'<br/>';
	}
	
}