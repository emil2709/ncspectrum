<?php

class Controller
{
	public function __construct()
	{
		echo "Main controller <br/>";
		$this->view = new View();
	}
}