<?php

// User Routes

Route::get('/', ['as' => 'users.wip', 'uses' => 'UserController@wip']);
Route::get('/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);
Route::get('/usersearch', ['as' => 'usersearch', 'uses' => 'UserController@usersearch']);


// Admin Routes

//Authentication Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('logout', 'Auth\LoginController@logout');

// Registration Routes 
Route::get('admin/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('admin/register', 'Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Auth::routes();

// Get
//Route::get('auth/login', ['as' => 'login', 'uses' => 'AdminController@index']);
//Route::get('admin/create/admin', ['as' => 'register', 'uses' => 'AdminController@createAdmin']);

Route::get('admin/dashboard', ['as' => 'admins.dashboard', 'uses' => 'AdminController@dashboard']);
Route::get('admin/{user}/edit', ['as' => 'admins.editUser', 'uses' => 'AdminController@editUser']);
Route::get('admin/guests', ['as' => 'admins.guests', 'uses' => 'AdminController@guests']);
Route::get('admin/log', ['as' => 'admins.log', 'uses' => 'AdminController@log']);
Route::get('admin/employees', ['as' => 'admins.employees', 'uses' => 'AdminController@employees']);
Route::get('admin/admins', ['as' => 'admins.admins', 'uses' => 'AdminController@admins']);
Route::get('admin/{user}', ['as' => 'admins.showUser', 'uses' => 'AdminController@showUser']);
Route::get('/search', ['as' => 'search', 'uses' => 'AdminController@search']);
Route::get('admin/{user}/userlog', ['as' => 'admins.userlog', 'uses' => 'AdminController@userlog']);

// Put
Route::put('admin/{user}', ['as' => 'admins.updateUser', 'uses' => 'AdminController@updateUser']);

// Delete
Route::delete('admin/{user}', ['as' => 'admins.destroyUser', 'uses' => 'AdminController@destroyUser']);
