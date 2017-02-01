<?php

class View
{

    private $model;
    private $controller;
    
    public function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }
    
    public function output()
    {
        return "<p><a href='Index.php?action=clicked'>".$this->model->text."</a></p>";
    }

}