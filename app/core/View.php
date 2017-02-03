<?php

class View
{
	public function __construct()
	{
		//echo "This is the View <br/>";
	}

	public function render($name)
	{
		require_once 'app/views/'.$name.'.php';
	}
}