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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/plants', 'PlantsController@index');

Route::get('/clients', 'ClientsController@index');
Route::get('/clients/create', 'ClientsController@create');
Route::post('/clients', 'ClientsController@store');
Route::get('/clients/{client}/edit', 'ClientsController@edit');
Route::put('/clients/{client}', 'ClientsController@update');
