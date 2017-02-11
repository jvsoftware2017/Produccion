<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/plants', 'PlantsController@index');
Route::post('/plants/store', 'PlantsController@store');
Route::post('/plants/edit/{plant}', 'PlantsController@update');

Route::get('/clients', 'ClientsController@index');
Route::get('/clients/create', 'ClientsController@create');
Route::post('/clients', 'ClientsController@store');
Route::get('/clients/{client}/edit', 'ClientsController@edit');
Route::put('/clients/{client}', 'ClientsController@update');