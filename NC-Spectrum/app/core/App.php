<?php

class App
{
    
    protected $controller = "UserController";
    
    protected $method = "index";
    
    protected $params = [];
    
    public function __construct()
    {
        
    }
    
    public function parseUrl()
    {
        if(isset($_GET["url"]))
        {
            
        }
    }
    
}


