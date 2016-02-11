<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses'=>'UserController@onPageChangePassword','middleware' => 'auth']);
Route::get('/login', 'Auth\AuthController@onPageLogin');
Route::get('/logout', 'Auth\AuthController@onLogout');
Route::post('/login/auth', 'Auth\AuthController@onLogin');
Route::group(['prefix' => 'administration','middleware' => 'auth'], function() {
	Route::get('/role', ['uses'=>'RoleController@index','middleware' => 'administrator']);
	Route::get('/role/form', ['uses'=>'RoleController@onForm','middleware' => 'administrator']);
	Route::get('/role/form/{id}', ['uses'=>'RoleController@onForm','middleware' => 'administrator']);
	Route::post('/role/store', ['uses'=>'RoleController@onStore','middleware' => 'administrator']);
	Route::post('/role/delete', ['uses'=>'RoleController@onDelete','middleware' => 'administrator']);
	
	Route::get('/user', ['uses'=>'UserController@index','middleware' => 'administrator']);
	Route::get('/user/form', ['uses'=>'UserController@onForm','middleware' => 'administrator']);
	Route::get('/user/form/{id}', ['uses'=>'UserController@onForm','middleware' => 'administrator']);
	Route::post('/user/store', ['uses'=>'UserController@onStore','middleware' => 'administrator']);
	Route::post('/user/delete', ['uses'=>'UserController@onDelete','middleware' => 'administrator']);
	Route::get('/user/reset-password/{id}', ['uses'=>'UserController@onPageResetPassword','middleware' => 'administrator']);
	Route::post('/user/reset-password/store', ['uses'=>'UserController@onResetPassword','middleware' => 'administrator']);
	
	Route::get('/companies', ['uses'=>'CompanyController@index','middleware' => 'administrator']);
	Route::get('/companies/form', ['uses'=>'CompanyController@onForm','middleware' => 'administrator']);
	Route::get('/companies/form/{id}', ['uses'=>'CompanyController@onForm','middleware' => 'administrator']);
	Route::post('/companies/store', ['uses'=>'CompanyController@onStore','middleware' => 'administrator']);
	Route::post('/companies/delete', ['uses'=>'CompanyController@onDelete','middleware' => 'administrator']);
	
	
});

Route::group(['prefix' => 'management','middleware' => 'auth'], function() {
	Route::get('/file', ['uses'=>'FileController@index','middleware' => 'administrator']);
	Route::get('/file/form', ['uses'=>'FileController@onForm','middleware' => 'administrator']);
	Route::get('/file/form/{id}', ['uses'=>'FileController@onForm','middleware' => 'administrator']);
	Route::post('/file/store', ['uses'=>'FileController@onStore','middleware' => 'administrator']);
	Route::post('/file/delete', ['uses'=>'FileController@onDelete','middleware' => 'administrator']);
	Route::get('/file/company', ['uses'=>'FileController@onCompanyList','middleware' => 'administrator']);
});
Route::group(['prefix' => 'setting','middleware' => 'auth'], function() {
	Route::get('/change-password', ['uses'=>'UserController@onPageChangePassword']);
	Route::post('/change-password/store', ['uses'=>'UserController@onChangePassword']);
	Route::get('/information', ['uses'=>'UserController@onPageInformation']);
});

Route::group(['prefix' => 'user','middleware' => 'auth'], function() {
	Route::get('/information', ['uses'=>'UserController@onPageUserInformation','middleware' => 'superuser']);
});


Route::group(['prefix' => 'file','middleware' => 'auth'], function() {
	Route::get('/download', ['uses'=>'FileController@onPageDownload']);
	Route::get('/download/{id}', ['uses'=>'FileController@onDownload']);
});

