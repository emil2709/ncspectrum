<?php

class App
{
	
	public function __construct()
	{		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		
		if(empty($url[0]))
		{
			require_once 'app/controllers/UserController.php';
			$controller = new UserController();
			return false;
		}

		//print_r($url);

		$file = 'app/controllers/' .$url[0]. '.php'; 
		if(file_exists($file))
		{
			require_once $file;
		}
		else
		{
			require_once 'app/controllers/ErrorController.php';
			$controller = new ErrorController();
			return false;
		}

		$controller = new $url[0];

		if(isset($url[2]))
		{
			$controller->{$url[1]}($url[2]);
		}
		else
		{
			if(isset($url[1]))
			{
				$controller->{$url[1]}();
			}
		}
	}


}