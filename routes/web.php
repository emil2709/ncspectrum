<?php

/** USER ROUTES **/

// GET ROUTES //

// Overview Page Routes
Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::get('/visit', ['as' => 'users.visit', 'uses' => 'UserController@visit']);

// Livesearch Route
Route::get('/usersearch', ['as' => 'usersearch', 'uses' => 'UserController@usersearch']);

// Guest Check-out Route
Route::get('/checkout', ['as' => 'checkout', 'uses' => 'UserController@checkout']);

// Guest Check-in list & Check-out list Synchronization Routes
Route::get('/listsync', ['as' => 'listsync', 'uses' => 'UserController@listsync']);
Route::get('/autosync', 'UserController@autosync');

// POST ROUTES // 

// Guest & Employee Creation Routes
Route::post('user', ['as' => 'users.storeUser', 'uses' => 'UserController@storeUser']);
Route::post('/visit', ['as' => 'users.storeVisit', 'uses' => 'UserController@storeVisit']);

// Check-in & Check-out Routes
Route::post('/statusin', 'UserController@statusin');
Route::post('/statusout', 'UserController@statusout');

// Guest Check-in list & Check-out list Synchronization Route
Route::post('/userlist', 'UserController@userlist');


/** ADMINISTRATOR ROUTES **/

// Authentication Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('logout', 'Auth\LoginController@logout');

// Registration Routes 
Route::get('admin/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('admin/register', 'Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// GET ROUTES //

// Overview Routes
Route::get('admin/dashboard', ['as' => 'admins.dashboard', 'uses' => 'AdminController@showDashboard']);
Route::get('admin/profile', ['as' => 'admins.showProfile', 'uses' => 'AdminController@showProfile']);
Route::get('admin/guests', ['as' => 'admins.guests', 'uses' => 'AdminController@showGuests']);
Route::get('admin/employees', ['as' => 'admins.employees', 'uses' => 'AdminController@showEmployees']);
Route::get('admin/admins', ['as' => 'admins.admins', 'uses' => 'AdminController@showAdmins']);
Route::get('admin/visits', ['as' => 'admins.visits', 'uses' => 'AdminController@showVisits']);
Route::get('admin/status', ['as' => 'admins.status', 'uses' => 'AdminController@showStatus']);

// Guest & Employee Creation Page Routes
Route::get('admin/guest/create', ['as' => 'admins.createGuest', 'uses' => 'AdminController@showCreateGuest']);
Route::get('admin/employee/create', ['as' => 'admins.createEmployee', 'uses' => 'AdminController@showCreateEmployee']);

// Guest, Employee & Administrator Edit Page Routes
Route::get('admin/guest/{guest}/edit', ['as' => 'admins.editGuest', 'uses' => 'AdminController@showEditGuest']);
Route::get('admin/employee/{employee}/edit', ['as' => 'admins.editEmployee', 'uses' => 'AdminController@showEditEmployee']);
Route::get('admin/admin/{admin}/edit', ['as' => 'admins.editAdmin', 'uses' => 'AdminController@showEditAdmin']);
Route::get('admin/password/{admin}/edit', ['as' => 'admins.editAdminPassword', 'uses' => 'AdminController@showEditAdminPassword']);

// Guest, Employee & Administrator Delete Page Routes
Route::get('admin/guest/{guest}/delete', ['as' => 'admins.deleteGuest', 'uses' => 'AdminController@showDeleteGuest']);
Route::get('admin/employee/{employee}/delete', ['as' => 'admins.deleteEmployee', 'uses' => 'AdminController@showDeleteEmployee']);
Route::get('admin/admin/{admin}/delete', ['as' => 'admins.deleteAdmin', 'uses' => 'AdminController@showDeleteAdmin']);

// Guest & Employee Visit Routes
Route::get('admin/guest/{user}/visits', ['as' => 'admins.guestvisits', 'uses' => 'AdminController@showGuestVisits']);
Route::get('admin/employee/{employee}/visits', ['as' => 'admins.employeevisits', 'uses' => 'AdminController@showEmployeeVisits']);

// Log Route
Route::get('admin/log', ['as' => 'admins.log', 'uses' => 'AdminController@showLog']);

// Status Check-out Route
Route::get('admin/guest/{id}/checkout', ['as' => 'admins.checkout', 'uses' => 'AdminController@checkout']);

// Livesearch Route
Route::get('/search', ['as' => 'search', 'uses' => 'AdminController@search']);

// POST ROUTES//

// Guest & Employee Creation Store Routes
Route::post('admin/guest/create', ['as' => 'admins.storeGuest', 'uses' => 'AdminController@storeGuest']);
Route::post('admin/employee/create', ['as' => 'admins.storeEmployee', 'uses' => 'AdminController@storeEmployee']);

// Avatar Upload Route
Route::post('admin/profile', ['as' => 'admins.updateAvatar', 'uses' => 'AdminController@updateAvatar']);

// PUT ROUTES//

// Guest, Employee & Administrator Update Routes
Route::put('admin/guest/{guest}', ['as' => 'admins.updateGuest', 'uses' => 'AdminController@updateGuest']);
Route::put('admin/employee/{employee}', ['as' => 'admins.updateEmployee', 'uses' => 'AdminController@updateEmployee']);
Route::put('admin/admin/{admin}', ['as' => 'admins.updateAdmin', 'uses' => 'AdminController@updateAdmin']);
Route::put('admin/password_{admin}', ['as' => 'admins.updateAdminPassword', 'uses' => 'AdminController@updateAdminPassword']);

// DELETE ROUTES //

// Guest, Employee & Administrator Delete Routes
Route::delete('admin/guest/{guest}', ['as' => 'admins.destroyGuest', 'uses' => 'AdminController@destroyGuest']);
Route::delete('admin/employee/{employee}', ['as' => 'admins.destroyEmployee', 'uses' => 'AdminController@destroyEmployee']);
Route::post('admin/admin/{admin}/delete', ['as' => 'admins.destroyAdmin', 'uses' => 'AdminController@destroyAdmin']);