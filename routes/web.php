<?php

// User Routes

Route::get('/', ['as' => 'users.wip', 'uses' => 'UserController@wip']);
Route::get('/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);
Route::get('/usersearch', ['as' => 'usersearch', 'uses' => 'UserController@usersearch']);


// Admin Routes

// Get
Route::get('auth/login', ['as' => 'login', 'uses' => 'AdminController@index']);
Route::get('admins/dashboard', ['as' => 'admins.dashboard', 'uses' => 'AdminController@dashboard']);
Route::get('admins/{user}/edit', ['as' => 'admins.editUser', 'uses' => 'AdminController@editUser']);
Route::get('admins/guests', ['as' => 'admins.guests', 'uses' => 'AdminController@guests']);
Route::get('admins/log', ['as' => 'admins.log', 'uses' => 'AdminController@log']);
Route::get('admins/employees', ['as' => 'admins.employees', 'uses' => 'AdminController@employees']);
Route::get('admins/admins', ['as' => 'admins.admins', 'uses' => 'AdminController@admins']);
Route::get('admins/{user}', ['as' => 'admins.showUser', 'uses' => 'AdminController@showUser']);
Route::get('/search', ['as' => 'search', 'uses' => 'AdminController@search']);
Route::get('admins/{user}/userlog', ['as' => 'admins.userlog', 'uses' => 'AdminController@userlog']);

// Put
Route::put('admins/{user}', ['as' => 'admins.updateUser', 'uses' => 'AdminController@updateUser']);

// Delete
Route::delete('admins/{user}', ['as' => 'admins.destroyUser', 'uses' => 'AdminController@destroyUser']);