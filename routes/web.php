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
			
			Route::post('/clients', 'ClientsController@store');
			
			Route::get('/us_equipments/{plant}', 'PlantsController@getEquipments');
			
		});
		
		Route::post('/users', 'UsersController@store');
		Route::put('/users/{user}', 'UsersController@update');
		
		Route::post('/equipments', 'EquipmentsController@store');
		Route::put('/equipments/{equipment}', 'EquipmentsController@update');
		
		Route::post('/plants', 'PlantsController@store');
		Route::put('/plants/{plant}', 'PlantsController@update');
		
		Route::put('/clients/{client}', 'ClientsController@update');
		
		Route::get('/plants', 'PlantsController@index');
		
		Route::get('/clients', 'ClientsController@index');
		
		Route::get('/equipments', 'EquipmentsController@index');
		
		Route::get('/users', 'UsersController@index');
		
		Route::get('/user-access', 'UserAccessController@index');
		
	});
	
	Route::get('/monitor', 'EquiposController@index');
	Route::get('/monitorLoad', 'EquiposController@refresh');
	Route::get('/monitor/{idEquipment}', 'EquiposController@detail');
	Route::get('/monitorDetailLoad/{idEquipment}', 'EquiposController@refreshDetail');
});
