<?php

class UserController extends Controller
{
    public function index($name = '')
    {
        echo "usercontroller/index";
        echo "$name";
    }
    
    public function test()
    {
        echo "test";
    }
}