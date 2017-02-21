<?php
// User Routes

Route::get('/', ['as' => 'users.wip', 'uses' => 'UserController@wip']);
Route::get('/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);

// Admin Routes

Route::get('auth/login', ['as' => 'login', 'uses' => 'AdminController@index']);
Route::get('admins/overview', ['as' => 'admins.overview', 'uses' => 'AdminController@overview']);
Route::get('admins/dashboard', ['as' => 'admins.dashboard', 'uses' => 'AdminController@dashboard']);
Route::get('admins/{admin}/edit', ['as' => 'admins.edit', 'uses' => 'AdminController@edit']);


Route::get('admins/users', 'AdminController@users');