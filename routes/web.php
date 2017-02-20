<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User Routes

Route::get('/', ['as' => 'users.wip', 'uses' => 'UserController@wip']);
Route::get('/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
Route::get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);

// Admin Routes

Route::get('auth/login', ['as' => 'login', 'uses' => 'AdminController@index']);
//Route::get('admins/overview', ['as' => 'admins.overview', 'uses' => 'AdminController@overview']);
Route::get('admins/overview', ['as' => 'admins.overview', 'uses' => 'AdminController@overview']);
Route::get('admins/{admin}/edit', ['as' => 'admins.edit', 'uses' => 'AdminController@edit']);