<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/active', 'Auth\LoginController@active');

Auth::routes();

Route::group(['middleware' => 'active'], function () {

	Route::get('/home', 'HomeController@index');
	Route::get('/user_profile', 'UsersController@showProfile');
	Route::put('/user_profile', 'UsersController@updateProfile');
	
	Route::group(['middleware' => 'client'], function () {
		
		Route::group(['middleware' => 'admin'], function () {
			
			Route::post('/plants', 'PlantsController@store');
			Route::put('/plants/{plant}', 'PlantsController@update');
			
			Route::post('/clients', 'ClientsController@store');
			Route::put('/clients/{client}', 'ClientsController@update');
			
			Route::post('/equipments', 'EquipmentsController@store');
			Route::put('/equipments/{equipment}', 'EquipmentsController@update');
			
			Route::post('/users', 'UsersController@store');
			Route::put('/users/{user}', 'UsersController@update');

			Route::get('/us_equipments/{plant}', 'PlantsController@getEquipments');
		});
		
		Route::get('/plants', 'PlantsController@index');
		
		Route::get('/clients', 'ClientsController@index');
		
		Route::get('/equipments', 'EquipmentsController@index');
		
		Route::get('/users', 'UsersController@index');
		
	});
});
