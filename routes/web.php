<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/plants', 'PlantsController@index');
Route::post('/plants/store', 'PlantsController@store');
Route::put('/plants/{plant}', 'PlantsController@update');

Route::get('/clients', 'ClientsController@index');
Route::post('/clients', 'ClientsController@store');
Route::put('/clients/{client}', 'ClientsController@update');

Route::get('/equipments', 'EquipmentsController@index');
Route::post('/equipments', 'EquipmentsController@store');
Route::put('/equipments/{equipment}', 'EquipmentsController@update');

Route::get('/users', 'UsersController@index');
Route::post('/users', 'UsersController@store');
Route::put('/users/{user}', 'UsersController@update');