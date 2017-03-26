<?php

/** User Routes **/

Route::get('/', ['as' => 'users.wip', 'uses' => 'UserController@wip']);
Route::get('/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);
Route::get('/usersearch', ['as' => 'usersearch', 'uses' => 'UserController@usersearch']);


/** Admin Routes **/

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

// Get
Route::get('admin/dashboard', ['as' => 'admins.dashboard', 'uses' => 'AdminController@showDashboard']);
Route::get('admin/profile', ['as' => 'admins.showProfile', 'uses' => 'AdminController@showProfile']);

Route::get('admin/guests', ['as' => 'admins.guests', 'uses' => 'AdminController@showGuests']);
Route::get('admin/employees', ['as' => 'admins.employees', 'uses' => 'AdminController@showEmployees']);
Route::get('admin/admins', ['as' => 'admins.admins', 'uses' => 'AdminController@showAdmins']);

Route::get('admin/guest/create', ['as' => 'admins.createGuest', 'uses' => 'AdminController@showCreateGuest']);
Route::get('admin/employee/create', ['as' => 'admins.createEmployee', 'uses' => 'AdminController@showCreateEmployee']);
Route::get('admin/visit/create', ['as' => 'admins.createVisit', 'uses' => 'AdminController@showCreateVisit']);

Route::get('admin/guest/{guest}/edit', ['as' => 'admins.editGuest', 'uses' => 'AdminController@showEditGuest']);
Route::get('admin/employee/{employee}/edit', ['as' => 'admins.editEmployee', 'uses' => 'AdminController@showEditEmployee']);
Route::get('admin/admin/{admin}/edit', ['as' => 'admins.editAdmin', 'uses' => 'AdminController@showEditAdmin']);
Route::get('admin/password/{admin}/edit', ['as' => 'admins.editAdminPassword', 'uses' => 'AdminController@showEditAdminPassword']);

Route::get('admin/guest/{guest}/delete', ['as' => 'admins.deleteGuest', 'uses' => 'AdminController@showDeleteGuest']);
Route::get('admin/employee/{employee}/delete', ['as' => 'admins.deleteEmployee', 'uses' => 'AdminController@showDeleteEmployee']);
Route::get('admin/admin/{admin}/delete', ['as' => 'admins.deleteAdmin', 'uses' => 'AdminController@showDeleteAdmin']);

Route::get('admin/log', ['as' => 'admins.log', 'uses' => 'AdminController@showLog']);
Route::get('admin/eployeeLog', ['as' => 'admins.employeelog', 'uses' => 'AdminController@employeeLog']);
Route::get('admin/{user}/userlog', ['as' => 'admins.userlog', 'uses' => 'AdminController@showUserlog']);
Route::get('admin/history', ['as' => 'admins.history', 'uses' => 'AdminController@showHistory']);
Route::get('/search', ['as' => 'search', 'uses' => 'AdminController@search']);

// Post
Route::post('admin/guest/create', ['as' => 'admins.storeGuest', 'uses' => 'AdminController@storeGuest']);
Route::post('admin/employee/create', ['as' => 'admins.storeEmployee', 'uses' => 'AdminController@storeEmployee']);
Route::post('admin/visit/create', ['as' => 'admins.storeVisit', 'uses' => 'AdminController@storeVisit']);
Route::post('admin/profile', ['as' => 'admins.updateAvatar', 'uses' => 'AdminController@updateAvatar']);
Route::post('admin/admin/{admin}/delete', ['as' => 'admins.destroyAdmin', 'uses' => 'AdminController@destroyAdmin']);

// Put
Route::put('admin/guest/{guest}', ['as' => 'admins.updateGuest', 'uses' => 'AdminController@updateGuest']);
Route::put('admin/employee/{employee}', ['as' => 'admins.updateEmployee', 'uses' => 'AdminController@updateEmployee']);
Route::put('admin/admin/{admin}', ['as' => 'admins.updateAdmin', 'uses' => 'AdminController@updateAdmin']);
Route::put('admin/password_{admin}', ['as' => 'admins.updateAdminPassword', 'uses' => 'AdminController@updateAdminPassword']);

// Delete
Route::delete('admin/guest/{guest}', ['as' => 'admins.destroyGuest', 'uses' => 'AdminController@destroyGuest']);
Route::delete('admin/employee/{employee}', ['as' => 'admins.destroyEmployee', 'uses' => 'AdminController@destroyEmployee']);
