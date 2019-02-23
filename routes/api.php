<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/climbers', 'ClimbersController@store');
Route::get('/climbers', 'ClimbersController@index');
Route::get('/climbers/{id}', 'ClimbersController@show');
Route::post('/locations', 'LocationsController@store');
Route::get('/locations', 'LocationsController@index');
