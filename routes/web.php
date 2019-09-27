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

Route::get('/', function () { return Redirect::to('registro-donador'); });
Route::get('registro-donador', [ 'as' => 'registro-donador', 'uses' => 'RegistroController']);

Route::get('login',['as'=>'login','uses'=>'LoginController']);

Route::middleware('auth')->get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::middleware('auth')->get('donadores',['as'=>'donadores','uses'=>'DonadoresController@index']);


