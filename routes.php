<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


 Route::get('/', function()
 {
 	return View::make('hello');
 });
//Route::get('/', 'UsersController@getLogin');
Route::controller('users', 'UsersController');
Route::get('pacientes', 'PacientesController@index');
Route::get('pacientes/buscar', 'PacientesController@show');
Route::post('pacientes/busqueda', 'PacientesController@busqueda');
Route::get('populate', 'PopulateController@populate');
Route::get('pacientes/{id}', 'PacientesController@verficha');
Route::post('pacientes/{id}/editarficha', 'PacientesController@editarficha');
