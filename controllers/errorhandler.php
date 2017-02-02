<?php

class Errorhandler extends Controller
{
	public function __construct()
	{
		parent::__construct();
		echo "There is an Error  <br/>";

		$this->view->render('public/errorpage');
	}
}