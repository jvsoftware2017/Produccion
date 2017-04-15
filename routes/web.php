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
			Route::get('/clientPlants/{idClient}', 'ClientsController@getPlants');
			Route::put('/clients/{client}', 'ClientsController@update');
			
			Route::post('/users', 'UsersController@store');
			Route::put('/users/{user}', 'UsersController@update');
			
			Route::post('/equipments', 'EquipmentsController@store');
			Route::put('/equipments/{equipment}', 'EquipmentsController@update');
			
			Route::post('/plants', 'PlantsController@store');
			Route::put('/plants/{plant}', 'PlantsController@update');
			
			Route::post('/user-access', 'UserAccessController@store');
			
			Route::get('/equipments', 'EquipmentsController@index');
			Route::get('/nav_equipments/{plant}', 'EquipmentsController@nav_index');
			
			Route::get('/plants', 'PlantsController@index');
			Route::get('/nav_plants/{client}', 'PlantsController@nav_index');
		});
		
		Route::get('/users', 'UsersController@index');
		
		
		Route::get('/clients', 'ClientsController@index');		
		
		Route::get('/user-access', 'UserAccessController@index');
		Route::get('/user-accessDelete/{idUserAccess}', 'UserAccessController@destroy');
		Route::get('/us_equipments/{plant}', 'PlantsController@getEquipments');
		
	});
	
	Route::get('/monitor', 'EquiposController@index');
	Route::get('/nav_monitor/{id_equipo}', 'EquiposController@nav_index');
	Route::get('/monitorLoad', 'EquiposController@refresh');
	Route::get('/nav_monitorLoad/{id_equipo}', 'EquiposController@nav_refresh');
	Route::get('/monitor/{idEquipment}', 'EquiposController@detail');
	Route::get('/monitorDetailLoad/{idEquipment}', 'EquiposController@refreshDetail');
	Route::get('/reports', 'ReportsController@index');
	Route::get('/report/{id_equipo}', 'ReportsController@report');
	Route::get('/gr_reports/{variable}/{id_equipo}/{mes}', 'ReportsController@returnValues');
	Route::get('/gr_reports_event/{variable}/{id_equipo}/{mes}', 'ReportsController@returnValuesEvent');
});
