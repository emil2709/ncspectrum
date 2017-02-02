<?php

class App
{
	
	public function __construct()
	{		
		if(isset($_GET['url']))
		{
			$url = $_GET['url'];
			$url = rtrim($url, '/');
			$url = explode('/', $url);
		}
		else 
		{
			return false;
		}

		//print_r($url);

		$file = 'controllers/' .$url[0]. '.php'; 
		if(file_exists($file))
		{
			require_once $file;
		}
		else
		{
			require_once 'controllers/ErrorController.php';
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