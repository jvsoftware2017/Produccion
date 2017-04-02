<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/active', 'Auth\LoginController@active');
Route::get('/validity', 'Auth\LoginController@validity');

Auth::routes();

Route::group(['middleware' => ['validity', 'active']], function () {

	Route::get('/home', 'HomeController@index');
	Route::get('/user_profile', 'UsersController@showProfile');
	Route::put('/user_profile', 'UsersController@updateProfile');
	
	Route::group(['middleware' => 'client'], function () {
		
		Route::group(['middleware' => 'admin'], function () {
			
			Route::post('/clients', 'ClientsController@store');
			Route::post('/user-access', 'UserAccessController@store');
			Route::get('/user-accessDelete/{idUserAccess}', 'UserAccessController@destroy');
			
			Route::get('/us_equipments/{plant}', 'PlantsController@getEquipments');
			Route::get('/clientPlants/{idClient}', 'ClientsController@getPlants');
			
		});
		
		Route::get('/users', 'UsersController@index');
		Route::post('/users', 'UsersController@store');
		Route::put('/users/{user}', 'UsersController@update');
		
		Route::get('/equipments', 'EquipmentsController@index');
		Route::get('/nav_equipments/{plant}', 'EquipmentsController@nav_index');
		Route::post('/equipments', 'EquipmentsController@store');
		Route::put('/equipments/{equipment}', 'EquipmentsController@update');
		
		Route::get('/plants', 'PlantsController@index');
		Route::get('/nav_plants/{client}', 'PlantsController@nav_index');
		Route::post('/plants', 'PlantsController@store');
		Route::put('/plants/{plant}', 'PlantsController@update');
		
		Route::get('/clients', 'ClientsController@index');
		Route::put('/clients/{client}', 'ClientsController@update');		
		
		Route::get('/user-access', 'UserAccessController@index');
		
	});
	
	Route::get('/monitor', 'EquiposController@index');
	Route::get('/monitorLoad', 'EquiposController@refresh');
	Route::get('/monitor/{idEquipment}', 'EquiposController@detail');
	Route::get('/monitorDetailLoad/{idEquipment}', 'EquiposController@refreshDetail');
});
